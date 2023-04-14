
const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorControls } = wp.editor;
const { PanelBody, SelectControl } = wp.components;
const { addFilter } = wp.hooks;
const { __ } = wp.i18n;

const enableBoxShadowControlOnBlocks = [
	'core/group',
	'core/row',
	'core/column',
];

const boxShadowControlOptions = [
	{
		label: __( 'None' ),
		value: '',
	},
	{
		label: __( 'Small' ),
		value: 'small',
	},
	// {
	// 	label: __( 'Medium' ),
	// 	value: 'medium',
	// },
	// {
	// 	label: __( 'Large' ),
	// 	value: 'large',
	// },
];

const addSpacingControlAttribute = ( settings, name ) => {
	if ( ! enableBoxShadowControlOnBlocks.includes( name ) ) {
		return settings;
	}


	settings.attributes = {
		...settings.attributes,
		boxShadow: {
			type: 'string',
			default: boxShadowControlOptions[0].value,
		},
	};

	return settings;
};

addFilter( 'blocks.registerBlockType', 'extend-block-example/attribute/spacing', addSpacingControlAttribute );

const withBoxShadowControl = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		if ( ! enableBoxShadowControlOnBlocks.includes( props.name ) ) {
			return (
				<BlockEdit { ...props } />
			);
		}

		const { boxShadow } = props.attributes;

		if ( boxShadow ) {
			props.attributes.className = `has-box-shadow-${ boxShadow }`;
		}

		return (
			<Fragment>
				<BlockEdit { ...props } />
				<InspectorControls>
					<PanelBody
						title={ __( 'Box Shadow' ) }
						initialOpen={ true }
					>
						<SelectControl
							label={ __( 'Box Shadow' ) }
							value={ boxShadow }
							options={ boxShadowControlOptions }
							onChange={ ( selectedBoxShadowOption ) => {
								props.setAttributes( {
									boxShadow: selectedBoxShadowOption,
								} );
							} }
						/>
					</PanelBody>
				</InspectorControls>
			</Fragment>
		);
	};
}, 'withBoxShadowControl' );

addFilter( 'editor.BlockEdit', 'extend-block-example/with-box-shadow-control', withBoxShadowControl );

const addExtraProps = ( saveElementProps, blockType, attributes ) => {
	if ( ! enableBoxShadowControlOnBlocks.includes( blockType.name ) ) {
		return saveElementProps;
	}

	const boxShadows = {
		small: '2px 5px 15px 5px rgba(0, 0, 0, 0.05)'
	};

	if ( attributes.boxShadow in boxShadows ) {
		saveElementProps = {
			...saveElementProps,
			style: {
				...saveElementProps.style,
				'box-shadow': boxShadows[attributes.boxShadow]
			}
		};
	}

	return saveElementProps;
};

addFilter( 'blocks.getSaveContent.extraProps', 'extend-block-example/get-save-content/extra-props', addExtraProps );
