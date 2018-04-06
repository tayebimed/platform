<?php

declare(strict_types=1);

namespace Orchid\Platform\Platform\Console\Commands;

use Illuminate\Console\Command;
use Orchid\Platform\Providers\FoundationServiceProvider;

class InstallCommand extends Command
{
    /**
     * @var
     */
    protected $progressBar;
    
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'orchid:install';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish files for ORCHID and install package"';
    
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->progressBar = $this->output->createProgressBar(8);
        
        $text = "
        ________________________________________________________________
               ____    _____     _____   _    _   _____   _____
              / __ \  |  __ \   / ____| | |  | | |_   _| |  __ \
             | |  | | | |__) | | |      | |__| |   | |   | |  | |
             | |  | | |  _  /  | |      |  __  |   | |   | |  | |
             | |__| | | | \ \  | |____  | |  | |  _| |_  | |__| |
              \____/  |_|  \_\  \_____| |_|  |_| |_____| |_____/
                             
                             Installation started. Please wait...
        ________________________________________________________________
        ";
    
        $this->info($text);
        
        $this->executeCommand('vendor:publish', ['--provider' => FoundationServiceProvider::class])
            ->executeCommand('vendor:publish', ['--all' => true])
            ->executeCommand('migrate')
            ->executeCommand('storage:link')
            ->executeCommand('orchid:link');
        
        $this->addLinkGitIgnore();
        $this->changingUserModel();
        $this->progressBar->finish();
        
        $this->info(" Completed!");
        $this->line("To create a user, run 'artisan make:admin'");
        $this->line("To start the embedded server, run 'artisan serve'");
    }
    
    /**
     * @param string $command
     * @param array  $parameters
     *
     * @return $this
     */
    private function executeCommand(string $command, $parameters = [])
    {
        if (!$this->progressBar->getProgress()) {
            $this->progressBar->start();
            echo ' ';
        }
        
        $result = $this->call($command, $parameters);
        if ($result) {
            $parameters = http_build_query($parameters, '', ' ');
            $parameters = str_replace("%5C", "/", $parameters);
            $this->alert("An error has occurred. The '{$command} {$parameters}' command was not executed");
        }
        
        $this->progressBar->advance();
        echo ' ';
        
        return $this;
    }
    
    /**
     *
     */
    private function changingUserModel()
    {
        $this->progressBar->advance();
        
        $this->info(' Attempting to set ORCHID User model as parent to App\User');
        
        if (!file_exists(app_path('User.php'))) {
            $this->warn('Unable to locate "app/User.php".  Did you move this file?');
            $this->warn('You will need to update this manually.  Change "extends Authenticatable" to "extends \Orchid\Platform\Core\Models\User" in your User model');
            return;
        }
        
        $str = file_get_contents(app_path('User.php'));
        
        if ($str !== false) {
            $str = str_replace('extends Authenticatable', "extends \Orchid\Platform\Core\Models\User", $str);
            file_put_contents(app_path('User.php'), $str);
        }
    }
    
    /**
     *
     */
    private function addLinkGitIgnore(){
    
        $this->progressBar->advance();
    
        $this->info(' Add semantic links to public files to ignore VCS');
        
        if (!file_exists(app_path('../.gitignore'))) {
            $this->warn('Unable to locate ".gitignore".  Did you move this file?');
            $this->warn('A semantic link to public files was not added to the ignore list');
            return;
        }
    
        $str = file_get_contents(app_path('../.gitignore'));
        
        if ($str !== false && strpos($str, '/public/orchid') === false) {
            file_put_contents(app_path('../.gitignore'), $str . PHP_EOL . '/public/orchid' . PHP_EOL);
        }
    }
    
}