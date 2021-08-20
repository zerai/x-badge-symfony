<?php declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
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
        // skip paths with legacy code
        __DIR__ . '/src/Kernel.php',
        // ignore specific error message
        #'Cognitive complexity for method "addAction" is 13 but has to be less than or equal to 8.',
    ]);

    // A. standalone rule
    $services = $containerConfigurator->services();
    $services->set(ArraySyntaxFixer::class)
        ->call('configure', [[
            'syntax' => 'short',
        ]]);

    // B. full sets
    $containerConfigurator->import(SetList::PSR_12);
};

