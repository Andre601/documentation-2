```yaml
title: validateIcon() in Iconify Utils
types:
  IconifyIconName: './icon-name.md'
```

# validateIcon()

This function is part of [Iconify Utils package](./index.md).

Function `[func]validateIcon()` validates icon name.

## Usage

Function has the following parameters:

- `[prop]name`, `[type]IconifyIconName | null`. Icon name.
- `[prop]allowSimpleName`, `[type]boolean`. Optional. If `true`, simple names without provider and prefix are considered valid.

Function returns `[type]boolean` value.

## Example

```yaml
src: tools/utils/validate-icon.ts
title: 'examples.ts'
```
