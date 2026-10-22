/**
 * Registers Sydney's shortcuts in the WordPress command palette (Cmd/Ctrl+K).
 *
 * The commands come from Sydney_Command_Palette::get_commands(). Each one opens
 * its URL, the same way core's admin menu commands do.
 */
( function() {

	'use strict';

	if ( ! window.wp || ! window.wp.data || ! window.sydneyCommandPalette ) {
		return;
	}

	window.sydneyCommandPalette.commands.forEach( function( command ) {
		window.wp.data.dispatch( 'core/commands' ).registerCommand( {
			name: command.name,
			label: command.label,
			searchLabel: command.label,
			keywords: command.keywords,
			category: 'view',
			callback: function( args ) {
				document.location = command.url;
				args.close();
			}
		} );
	} );

} )();
