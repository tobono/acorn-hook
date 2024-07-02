# Acorn Hook

A package for [Acorn](https://github.com/roots/acorn) or [Sage 10](https://github.com/roots/sage) based projects
that wraps WordPress Hook API.

## Installation

Install via composer:

```bash
composer require tobono/acorn-hook
```

## Usage

**Example**
```php
//...
    use Tobono\Hook\Facades\Action;
    use Tobono\Hook\Facades\Filter;
    
    // do_action, do_action_ref_array
    Action::dispatch('orderPlaced', $order);
    
    // apply_filters, apply_filters_ref_array
    $postTitle = Filter::dispatch('the_title', $postTitle, $postId);

//...
```
