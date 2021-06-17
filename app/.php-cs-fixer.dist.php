<?php

$finder = PhpCsFixer\Finder::create()
    ->in('bin')
    ->in('src')
    ->in('migrations')
    ->exclude('vendor')
;

$config = new PhpCsFixer\Config();

return $config
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PSR2' => true,
        '@DoctrineAnnotation' => true,
        'array_syntax' => ['syntax' => 'short'],
        'fully_qualified_strict_types' => true, // Transforms imported FQCN parameters and return types in function arguments to short version.
        'dir_constant' => true, // Replaces dirname(__FILE__) expression with equivalent __DIR__ constant.
        'heredoc_to_nowdoc' => true,
        'linebreak_after_opening_tag' => true, // Ensure there is no code on the same line as the PHP open tag.
        'multiline_whitespace_before_semicolons' => true, // Forbid multi-line whitespace before the closing semicolon or move the semicolon to the new line for chained calls.
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_class_elements' => true, // Orders the elements of classes/interfaces/traits.
        'ordered_imports' => true,
        'phpdoc_add_missing_param_annotation' => ['only_untyped' => false], // PHPDoc should contain @param for all params (for untyped parameters only).
        'phpdoc_order' => true, // Annotations in PHPDoc should be ordered so that @param annotations come first, then @throws annotations, then @return annotations.
        'no_php4_constructor' => true, // Convert PHP4-style constructors to __construct.
        'semicolon_after_instruction' => true,
        'align_multiline_comment' => true,
        'blank_line_after_opening_tag' => false,
        'single_blank_line_at_eof' => true,
        'declare_strict_types' => true,
        'general_phpdoc_annotation_remove' => ['annotations' => ['author', 'package']],
        'list_syntax' => ['syntax' => 'short'],
        'phpdoc_to_comment' => false
    ])
    ;