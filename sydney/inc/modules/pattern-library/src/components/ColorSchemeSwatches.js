import { __ } from '@wordpress/i18n';

const STEPS = { ArrowRight: 1, ArrowDown: 1, ArrowLeft: -1, ArrowUp: -1 };
const LABEL_ID = 'sydney-pattern-library-color-scheme-label';

/**
 * The Color scheme picker: a visible label, then one round swatch per scheme
 * as a radio group named by that label. Arrow keys move the choice, like
 * native radio buttons.
 *
 * @param {Object}   props
 * @param {string}   props.value    The selected scheme.
 * @param {Function} props.onChange Called with the chosen scheme.
 */
export function ColorSchemeSwatches( { value, onChange } ) {
	const schemes = [
		{ scheme: 'white', label: __( 'White', 'sydney' ) },
		{ scheme: 'grey', label: __( 'Grey', 'sydney' ) },
		{ scheme: 'dark', label: __( 'Dark', 'sydney' ) },
	];

	function handleKeyDown( event, index ) {
		const step = STEPS[ event.key ];
		if ( ! step ) {
			return;
		}
		event.preventDefault();
		const next = ( index + step + schemes.length ) % schemes.length;
		onChange( schemes[ next ].scheme );
		event.currentTarget.parentElement.children[ next ].focus();
	}

	return (
		<div className="sydney-pattern-library-color-scheme">
			<span
				id={ LABEL_ID }
				className="sydney-pattern-library-color-scheme-label"
			>
				{ __( 'Color scheme', 'sydney' ) }
			</span>
			<div
				className="sydney-pattern-library-color-scheme-swatches"
				role="radiogroup"
				aria-labelledby={ LABEL_ID }
			>
				{ schemes.map( ( { scheme, label }, index ) => {
					const isSelected = value === scheme;
					return (
						<button
							key={ scheme }
							type="button"
							role="radio"
							aria-checked={ isSelected }
							aria-label={ label }
							title={ label }
							tabIndex={ isSelected ? 0 : -1 }
							className={ `sydney-pattern-library-swatch is-${ scheme }${
								isSelected ? ' is-selected' : ''
							}` }
							onClick={ () => onChange( scheme ) }
							onKeyDown={ ( event ) =>
								handleKeyDown( event, index )
							}
						/>
					);
				} ) }
			</div>
		</div>
	);
}
