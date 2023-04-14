import {useBlockProps, InnerBlocks} from '@wordpress/block-editor';
import classnames from "classnames";

export default function Save({attributes}) {
	const {
		openButtonLabel,
		openButtonWidth,
		openButtonStyle,
		modalId,
		openButtonAlignment
	} = attributes;

	const blockProps = useBlockProps.save({
		className: 'modal-content',
	});


	return (
		<div data-modal={true} id={modalId}>
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
					<a type="button" className="wp-block-button__link wp-element-button modal-open"
					  >{openButtonLabel}</a>
				</div>
			</div>
			<div className="modal-screen-overlay">
				<div className="modal-frame">
					<div {...blockProps}>
						<a className="modal-close" href="void:javascript(0)">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
								 height="24"
								 aria-hidden="true" focusable="false">
								<path
									d="M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z"></path>
							</svg>
						</a>
						<div>
							<InnerBlocks.Content/>
						</div>
					</div>
				</div>
			</div>
		</div>
	);
}


