<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
       __DIR__ . '/app',
       __DIR__ . '/bootstrap',
       __DIR__ . '/config',
       __DIR__ . '/database',
       __DIR__ . '/resources',
       __DIR__ . '/routes',
       __DIR__ . '/tests',
   ]);

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setIndent("    ")
    ->setLineEnding("\n")
    ->setRules([
        'indentation_type' => true,
        'line_ending' => true,
        'visibility_required' => true,
        'ternary_to_null_coalescing' => true,
        'binary_operator_spaces' => [
            'default' => 'single_space',
            'operators' => [
                '=>' => 'align_single_space_minimal',
            ],
        ],
        'blank_line_after_opening_tag' => false,
        'blank_line_before_statement' => [
            'statements' => [
                'return',
            ],
        ],
        'braces' => [
            'allow_single_line_closure' => true,
        ],
        'cast_spaces' => true,
        'class_definition' => [
            'single_line' => true,
        ],
        'concat_space' => [
            'spacing' => 'one',
        ],
        'declare_equal_normalize' => true,
        'function_typehint_space' => true,
        'include' => true,
        'increment_style' => [
            'style' => 'post',
        ],
        'lowercase_cast' => true,
        'magic_constant_casing' => true,
        'method_argument_space' => true,
        'class_attributes_separation' => [
            'elements' => [
                'method' => 'one',
            ],
        ],
        'native_function_casing' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_extra_blank_lines' => [
            'tokens' => [
                'curly_brace_block',
                'extra',
                'parenthesis_brace_block',
                'square_brace_block',
                'throw',
                'use',
            ],
        ],
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_mixed_echo_print' => [
            'use' => 'echo',
        ],
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_short_bool_cast' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_spaces_around_offset' => true,
        'no_trailing_comma_in_singleline' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unneeded_curly_braces' => true,
        'no_unneeded_final_method' => true,
        'no_unused_imports' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'normalize_index_brace' => true,
        'object_operator_without_whitespace' => true,
        'ordered_imports' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_align' => true,
        'phpdoc_indent' => true,
        'phpdoc_inline_tag_normalizer' => true,
        'phpdoc_no_access' => true,
        'phpdoc_no_alias_tag' => true,
        'phpdoc_no_package' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_order' => true,
        'phpdoc_scalar' => true,
        'phpdoc_separation' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => true,
        'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'phpdoc_types_order' => [
            'null_adjustment' => 'always_last',
        ],
        'phpdoc_var_without_name' => true,
        'protected_to_private' => true,
        'semicolon_after_instruction' => true,
        'short_scalar_cast' => true,
        'single_blank_line_before_namespace' => false,
        'single_class_element_per_statement' => true,
        'single_line_comment_style' => [
            'comment_types' => [
                'hash',
            ],
        ],
        'single_quote' => true,
        'space_after_semicolon' => [
            'remove_in_empty_for_expressions' => true,
        ],
        'standardize_not_equals' => true,
        'ternary_operator_spaces' => true,
        'trailing_comma_in_multiline' => [
            'elements' => [
                'arrays',
            ],
        ],
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
        'whitespace_after_comma_in_array' => true,
        'blank_line_after_namespace' => true,
        'elseif' => true,
        'function_declaration' => true,
        'indentation_type' => true,
        'line_ending' => true,
        'constant_case' => [
            'case' => 'lower',
        ],
        'lowercase_keywords' => true,
        'no_break_comment' => true,
        'no_useless_return' => true,
        'no_closing_tag' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'single_blank_line_at_eof' => true,
        'single_import_per_statement' => true,
        'single_line_after_imports' => true,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'encoding' => true,
        'full_opening_tag' => true,
        'no_superfluous_elseif' => true,
        'no_useless_else' => true,
        'compact_nullable_typehint' => true,
        'align_multiline_comment' => true,
        'combine_consecutive_issets' => true,
        'list_syntax' => [
            'syntax' => 'short',
        ],
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'combine_consecutive_unsets' => true,
        'multiline_whitespace_before_semicolons' => true,
        'no_null_property_initialization' => true,
        'echo_tag_syntax' => [
            'format' => 'long',
        ],
    ])->setFinder($finder);

return $config;
