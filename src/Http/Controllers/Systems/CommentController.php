<?php

namespace Orchid\Platform\Http\Controllers\Systems;

use Illuminate\Http\Request;
use Orchid\Alert\Facades\Alert;
use Orchid\Platform\Core\Models\Comment;
use Orchid\Platform\Http\Forms\Comment\CommentFormGroup;
use Orchid\Platform\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * @var CommentFormGroup
     */
    public $form;

    /**
     * CommentController constructor.
     *
     * @param CommentFormGroup $form
     */
    public function __construct(CommentFormGroup $form)
    {
        $this->checkPermission('dashboard.tools.comment');
        $this->form = $form;
    }

    /**
     * @return string
     */
    public function index()
    {
        return $this->form->grid();
    }

    /**
     * @param Request $request
     * @param Comment $comment
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Comment $comment)
    {
        $this->form->save($request, $comment);

        Alert::success(trans('dashboard::common.alert.success'));

        return redirect()->route('dashboard.tools.comment.edit', $comment->id);
    }

    /**
     * @param Comment $comment
     *
     * @return mixed
     */
    public function edit(Comment $comment)
    {
        return $this->form
            ->route('dashboard.tools.comment.update')
            ->slug($comment->id)
            ->method('PUT')
            ->render($comment);
    }

    /**
     * @param Comment $comment
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        $this->form->remove($comment);

        Alert::success(trans('dashboard::common.alert.success'));

        return redirect()->route('dashboard.tools.comment');
    }
}
