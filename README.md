```bash
composer install

vendor/bin/rector 

 1/1 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%
                                                                                                                        
 [ERROR] Could not process                                                                                              
         "/Users/samsonasik/www/symfony-container-error-rector/src/Symfony_DI_PhpDumper_Test_Autowire_Closure.php" file,
         due to:                                                                                                        
         "System error: "Node "PhpParser\Node\Expr\ClassConstFetch" with is missing scope required for scope refresh"   
         Run Rector with "--debug" option and post the report here: https://github.com/rectorphp/rector/issues/new". On line: 87
                                                                                                                        
```
