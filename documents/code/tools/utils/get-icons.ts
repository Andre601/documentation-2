import { icons } from '@iconify-json/mdi-light';
import { getIcons } from '@iconify/utils/lib/icon-set/get-icons';

// Get few icons
const reducedIconSet = getIcons(icons, [
	'alarm',
	'arrow-down',
	'home',
	'home-outline',
]);

// Log it
console.log(reducedIconSet);
