➜  symfony-container-error-rector git:(main) composer install
Installing dependencies from lock file (including require-dev)
Verifying lock file contents can be installed on current platform.
Nothing to install, update or remove
Generating autoload files
7 packages you are using are looking for funding.
Use the `composer fund` command to find out more!
➜  symfony-container-error-rector git:(main) vendor/bin/rector 
 1/1 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%
                                                                                                                        
 [ERROR] Could not process                                                                                              
         "/Users/samsonasik/www/symfony-container-error-rector/src/Symfony_DI_PhpDumper_Test_Autowire_Closure.php" file,
         due to:                                                                                                        
         "System error: "Node "PhpParser\Node\Expr\ClassConstFetch" with is missing scope required for scope refresh"   
         Run Rector with "--debug" option and post the report here: https://github.com/rectorphp/rector/issues/new". On line: 87
                                                                                                                        
