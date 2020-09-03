import { MDContext } from '../types';
import { checkLinkables } from './linkable';

export function linkClasses(
	$html: CheerioStatic,
	context: MDContext,
	classes: Record<string, string>
): void {
	return checkLinkables($html, context, classes, {
		selector: '.hljs-class',
		title: '{item} documentation',
	});
}
