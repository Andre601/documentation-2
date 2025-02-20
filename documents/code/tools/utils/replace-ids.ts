import { fullIcon } from '@iconify/utils/lib/icon';
import { iconToSVG } from '@iconify/utils/lib/svg/build';
import { defaults } from '@iconify/utils/lib/customisations';
import { replaceIDs } from '@iconify/utils/lib/svg/id';

const iconData = fullIcon({
	body: '<defs><linearGradient id="a" x1="4.416" y1="-1909.341" x2="13.909" y2="-1892.9" gradientTransform="translate(0 1917.121)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#b72c3f"/><stop offset=".5" stop-color="#b12334"/><stop offset="1" stop-color="#9d1623"/></linearGradient></defs><path d="M8.512 20v6.667c0 1.84 4.81 3.333 10.744 3.333S30 28.507 30 26.667V20z" fill="#881421"/><path d="M8.512 12.667V20c0 1.841 4.81 3.333 10.744 3.333S30 21.841 30 20v-7.333z" fill="#af2031"/><path d="M8.512 5.333v7.334c0 1.84 4.81 3.333 10.744 3.333S30 14.507 30 12.667V5.333z" fill="#c94f60"/><ellipse cx="19.256" cy="5.333" rx="10.744" ry="3.333" fill="#e08095"/><path d="M16.434 8H8.512v16.667h7.922a1.212 1.212 0 0 0 1.194-1.222V9.222A1.212 1.212 0 0 0 16.434 8z" opacity=".1"/><path d="M15.783 8.667H8.512v16.666h7.271a1.212 1.212 0 0 0 1.194-1.222V9.889a1.212 1.212 0 0 0-1.194-1.222z" opacity=".2"/><path d="M15.783 8.667H8.512V24h7.271a1.212 1.212 0 0 0 1.194-1.222V9.889a1.212 1.212 0 0 0-1.194-1.222z" opacity=".2"/><path d="M15.132 8.667h-6.62V24h6.62a1.213 1.213 0 0 0 1.194-1.222V9.889a1.213 1.213 0 0 0-1.194-1.222z" opacity=".2"/><path d="M3.194 8.667h11.938a1.208 1.208 0 0 1 1.194 1.222v12.222a1.208 1.208 0 0 1-1.194 1.222H3.194A1.208 1.208 0 0 1 2 22.111V9.889a1.208 1.208 0 0 1 1.194-1.222z" fill="url(#a)"/><path d="M8.305 12.027h1.758l2.825 7.945h-1.66l-.623-1.895H7.7l-.611 1.895H5.437zm1.926 4.826-.9-2.875a3.812 3.812 0 0 1-.165-.649H9.13a3.729 3.729 0 0 1-.162.671l-.912 2.859z" fill="#fff"/>',
	width: 32,
	height: 32,
});

// Use it to render icon
const renderData = iconToSVG(iconData, defaults);

// Generate attributes for SVG element
const svgAttributes: Record<string, string> = {
	'xmlns': 'http://www.w3.org/2000/svg',
	'xmlns:xlink': 'http://www.w3.org/1999/xlink',
	...renderData.attributes,
};
if (renderData.inline) {
	svgAttributes.style = 'vertical-align: -0.125em;';
}
const svgAttributesStr = Object.keys(svgAttributes)
	.map(
		(attr) =>
			// No need to check attributes for special characters, such as quotes,
			// they cannot contain anything that needs escaping.
			`${attr}="${svgAttributes[attr as keyof typeof svgAttributes]}"`
	)
	.join(' ');

// Generate SVG
const svg = replaceIDs(`<svg ${svgAttributesStr}>${renderData.body}</svg>`);

// Log SVG
console.log(svg);
