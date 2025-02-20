```yaml
title: IconifyIconName Type
standalone: true
navigation: './index.md'
```

# IconifyIconName type

`[type]IconifyIconName` type is used in [Iconify Utils](./index.md) to handle icon names.

You can find this type in `[file]src/icon/name.ts` of [Iconify Utils source code](https://github.com/iconify/iconify/tree/master/packages/utils).

`include types/iconify-icon-name`

## Validation

All parts of icon name must match the following regular expression: `[js]/^[a-z0-9]+(-[a-z0-9]+)*$/`.

The only exeption is `[prop]provider`, which can be empty.

Expression for validation can be imported from Iconify Utils:

```js
import { matchName } from '@iconify/utils/lib/icon';

const prefix = 'test-prefix';
if (prefix.match(matchName)) {
	// Prefix is valid
}
```
