<?php

use TRegx\CleanRegex\Pattern;

if (!function_exists('pattern')) {
    function pattern(string $pattern, string $modifiers = null): Pattern
    {
        return Pattern::of($pattern, $modifiers);
    }
}

function pattern_test(string $pattern, string $subject, string $modifiers = ''): bool
{
    return Pattern::of($pattern, $modifiers)->test($subject);
}

function pattern_fails(string $pattern, string $subject, string $modifiers = ''): bool
{
    return Pattern::of($pattern, $modifiers)->fails($subject);
}

/**
 * @return string[]
 */
function pattern_split(string $pattern, string $subject, string $modifiers = ''): array
{
    return Pattern::of($pattern, $modifiers)->split($subject);
}

/**
 * @return string[]
 */
function pattern_cut(string $pattern, string $subject, string $modifiers = ''): array
{
    return Pattern::of($pattern, $modifiers)->cut($subject);
}

/**
 * @param string $pattern
 * @param string[] $subjects
 * @param string $modifiers
 * @return string[]
 */
function pattern_filter(string $pattern, array $subjects, string $modifiers = ''): array
{
    return Pattern::of($pattern, $modifiers)->filter($subjects);
}

/**
 * @param string $pattern
 * @param string[] $subjects
 * @param string $modifiers
 * @return string[]
 */
function pattern_reject(string $pattern, array $subjects, string $modifiers = ''): array
{
    return Pattern::of($pattern, $modifiers)->reject($subjects);
}
