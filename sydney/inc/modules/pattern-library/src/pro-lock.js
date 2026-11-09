/**
 * Whether a card is locked: a Pro pattern on a site without Pro.
 *
 * @param {Object}  pattern A library pattern.
 * @param {boolean} isPro   Whether the site runs Sydney Pro.
 * @return {boolean} True when the pattern can only be previewed.
 */
export const isLockedPattern = ( pattern, isPro ) =>
	Boolean( pattern.sydney_pro ) && ! isPro;

/**
 * The grid order: every pattern the site can insert, then the locked ones.
 * Each group keeps its order, so on Pro the list is returned as it came.
 *
 * @param {Object[]} patterns Patterns in display order.
 * @param {boolean}  isPro    Whether the site runs Sydney Pro.
 * @return {Object[]} A new list with the locked patterns last.
 */
export function lockedLast( patterns, isPro ) {
	const unlocked = patterns.filter( ( p ) => ! isLockedPattern( p, isPro ) );
	const locked = patterns.filter( ( p ) => isLockedPattern( p, isPro ) );
	return [ ...unlocked, ...locked ];
}
