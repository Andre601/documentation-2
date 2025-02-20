```yaml
title: 'Iconify for Vue Offline Use'
functions:
  addCollection: './add-collection.md'
  addIcon: './add-icon.md'
```

# Iconify for Vue offline use

```yaml
include: icon-components/components/intro-offline
```

See [icon bundles for Iconify for Vue](../../icon-components/bundles/vue2.md) documentation.

## Offline component

Additionally, if you do not want to include API functionality, you can import component without API support. It is a bit smaller than full component.

In your code replace:

```js
import { Icon } from '@iconify/vue2';
```

with

```js
import { Icon } from '@iconify/vue2/dist/offline';
```

Offline component has only the following functions available:

- `[func]addIcon()`. Adds one icon.
- `[func]addCollection()`. Adds an icon set.

```yaml
src: icon-components/common/offline.vue
replacements:
  - search: iconify/vue
    replace: iconify/vue2
```

## Available icons

`include icons/packages-intro`

If you want to use icon packages, as shown in example above, see [icon packages documentation](../../icons/icons.md) for more information.

### Icon packages {#modules}

Example above imports icon from package `[npm]@iconify-icons/bi`, which is a ES module.

If you are experiencing errors using packages from `[npm]@iconify-icons`, there are CommonJS packages with exactly the same data. To switch to CommonJS package, instead of `[npm]@iconify-icons/bi` use `[npm]@iconify/icons-bi`, so import line looks like this:

```js
import bellFill from '@iconify/icons-bi/bell-fill';
```

Format for icon data packages:

- ES package: `[npm]@iconify-icons/{prefix}`
- CommonJS package: `[npm]@iconify/icons-{prefix}`

where `[str]{prefix}` is icon set prefix. Use ES package whenever possible, switch to CommonJS package if your bundler does not support ES modules or if you need to use it in Node.js.

See [individual icon packages documentation](../../icons/icons.md).
