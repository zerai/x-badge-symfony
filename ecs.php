<?php declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\NamespaceNotation\BlankLineAfterNamespaceFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        //__DIR__ . '/tests'
    ]);
    $parameters->set(Option::SKIP, [
        __DIR__ . '/src/Kernel.php',

        // ignore specific error message
        #'Cognitive complexity for method "addAction" is 13 but has to be less than or equal to 8.',
    ]);


    $services = $containerConfigurator->services();

    $services->set(DeclareStrictTypesFixer::class);

    $services->set(NoUnusedImportsFixer::class);

    $services->set(BlankLineAfterNamespaceFixer::class);

    $services->set(NativeFunctionInvocationFixer::class);

    $services->set(StrictComparisonFixer::class);

    $services->set(ArraySyntaxFixer::class)
        ->call('configure', [[
            'syntax' => 'short',
        ]]);


    $containerConfigurator->import(SetList::PSR_12);
};

