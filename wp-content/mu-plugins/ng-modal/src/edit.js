import {Button, TextControl, PanelBody, ButtonGroup, BaseControl} from '@wordpress/components';
import {useState, useCallback} from '@wordpress/element';
import {useDispatch} from '@wordpress/data';
import classnames from 'classnames';
import {InspectorControls, useBlockProps, InnerBlocks} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';

function ButtonStylePanel({selectedButtonStyle, setAttributes}) {
	const handleChange = useCallback((newButtonStyle) => {
		const openButtonStyle = selectedButtonStyle === newButtonStyle ? undefined : newButtonStyle;
		setAttributes({openButtonStyle});
	}, [selectedButtonStyle, setAttributes]);

	return (
		<BaseControl
			__nextHasNoMarginBottom
		>
			<BaseControl.VisualLabel>
				Style du bouton
			</BaseControl.VisualLabel>
			<div>
				<ButtonGroup aria-label={__('Button style')}>
					{[
						{"name": "fill", "label": "Fill"},
						{"name": "outline", "label": "Outline"}
					].map((style) => {
						return (
							<Button
								key={style.name}
								variant={style.name === selectedButtonStyle ? 'primary' : undefined}
								onClick={() => handleChange(style.name)}
							>
								{style.label}
							</Button>
						);
					})}
				</ButtonGroup>
			</div>
		</BaseControl>
	);
}

function WidthPanel({selectedWidth, setAttributes}) {
	const handleChange = useCallback(
		(newWidth) => {
			const openButtonWidth = selectedWidth === newWidth ? undefined : newWidth;
			setAttributes({openButtonWidth});
		},
		[selectedWidth, setAttributes]
	);

	return (
		<BaseControl __nextHasNoMarginBottom>
			<BaseControl.VisualLabel>Largeur du bouton</BaseControl.VisualLabel>
			<div>
				<ButtonGroup aria-label={__('Button width')}>
					{[25, 50, 75, 100].map((widthValue) => {
						return (
							<Button
								key={widthValue}
								isSmall
								variant={widthValue === selectedWidth ? 'primary' : undefined}
								onClick={() => handleChange(widthValue)}
							>
								{widthValue}%
							</Button>
						);
					})}
				</ButtonGroup>
			</div>
		</BaseControl>
	);
}

function ButtonAlignmentPanel({selectedButtonAlignment, setAttributes}) {
	const handleChange = useCallback(
		(newButtonAlignment) => {
			const openButtonAlignment = selectedButtonAlignment === newButtonAlignment ? undefined : newButtonAlignment;
			setAttributes({openButtonAlignment});
		},
		[selectedButtonAlignment, setAttributes]
	);

	const buttonAlignmentIcons = {
		"left": <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true"
					 focusable="false">
			<path d="M9 9v6h11V9H9zM4 20h1.5V4H4v16z"></path>
		</svg>,
		"center": <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true"
					   focusable="false">
			<path d="M20 9h-7.2V4h-1.6v5H4v6h7.2v5h1.6v-5H20z"></path>
		</svg>,
		"right": <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true"
					  focusable="false">
			<path d="M4 15h11V9H4v6zM18.5 4v16H20V4h-1.5z"></path>
		</svg>
	}

	return (
		<BaseControl __nextHasNoMarginBottom>
			<BaseControl.VisualLabel>Alignement du bouton</BaseControl.VisualLabel>
			<div>
				<ButtonGroup aria-label={__('Button alignment')}>
					{['left', 'center', 'right'].map((alignment) => {
						return (
							<Button
								key={alignment}
								variant={alignment === selectedButtonAlignment ? 'primary' : undefined}
								onClick={() => handleChange(alignment)}
							>
								{buttonAlignmentIcons[alignment]}
							</Button>
						);
					})}
				</ButtonGroup>
			</div>
		</BaseControl>
	);
}

export default function Edit(
	{
		attributes: {
			openButtonLabel,
			openButtonWidth,
			openButtonStyle,
			modalId,
			openButtonAlignment
		}, setAttributes, clientId
	}) {

	const [showModal, setShowModal] = useState(false);
	const dispatch = useDispatch();
	const blockProps = useBlockProps({
		className: 'modal-content',
	});

	if (!modalId) {
		setAttributes({modalId: clientId});
	}

	const closeModal = useCallback(() => {
		setShowModal(false);
		dispatch('core/block-editor').clearSelectedBlock();
	}, [dispatch]);

	const openModal = useCallback(() => {
		setShowModal(true);
		dispatch('core/block-editor').selectBlock(clientId);
	}, [clientId, dispatch]);

	function setOpenButtonLabel(openButtonLabel) {
		setAttributes({openButtonLabel: openButtonLabel});
	}

	return (
		<div>
			<InspectorControls>
				<PanelBody title="Bouton">
					<TextControl
						label="Texte du bouton"
						value={openButtonLabel}
						onChange={(openButtonLabel) => setOpenButtonLabel(openButtonLabel)}
					/>
					<WidthPanel
						selectedWidth={openButtonWidth}
						setAttributes={setAttributes}
					/>
					<ButtonStylePanel
						selectedButtonStyle={openButtonStyle}
						setAttributes={setAttributes}
					/>
					<ButtonAlignmentPanel
						selectedButtonAlignment={openButtonAlignment}
						setAttributes={setAttributes}
					/>
				</PanelBody>

			</InspectorControls>

			<div
				className={classnames(
					'is-layout-flex wp-block-buttons', {
						[`is-content-justification-${openButtonAlignment}`]: openButtonAlignment,
					})}>
				<div
					className={classnames(
						'wp-block-button', {
							[`has-custom-width wp-block-button__width-${openButtonWidth}`]: openButtonWidth,
							[`is-style-${openButtonStyle}`]: openButtonStyle,
						})}
				>
					<a className="wp-block-button__link wp-element-button modal-open"
					   onClick={openModal}>{openButtonLabel}</a>
				</div>
			</div>
			{showModal && (
				<div className="modal-screen-overlay" onClick={closeModal}>
					<div className="modal-frame">
						<div  {...blockProps} onClick={event => event.stopPropagation()}>
							<a
								className="modal-close"
								onClick={closeModal}
							>
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
									 height="24"
									 aria-hidden="true" focusable="false">
									<path
										d="M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z"></path>
								</svg>
							</a>

							<div>
								<InnerBlocks/>
							</div>
						</div>
					</div>
				</div>
			)}
		</div>
	);
}

