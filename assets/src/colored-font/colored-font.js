import './colored-font.editor.scss';
import './colored-font.view.scss';

const {
    registerBlockType,
} = wp.blocks;

const {
    InspectorControls,
    RichText,
    ColorPalette,
} = wp.editor;

registerBlockType('rfugroup/colored-font', {
    title: 'Colored Font',
    icon: 'admin-appearance',
    category: 'ugroup-blocks',

    attributes: {
        textString: {
            type: 'array',
            source: 'children',
            selector: 'h2',
        },
        fontColor: {
            type: 'string',
            default: null // let's get rid of the annoying orange
        },
    },


    edit(props) {

        const {
            setAttributes,
            attributes,
            className
        } = props;
        const { fontColor, overlayColor } = props.attributes;

        function onTextChange(changes) {
            setAttributes({
                textString: changes
            });
        }

        function onTextColorChange(changes) {
            setAttributes({
                fontColor: changes
            })
        }

        return ([
            <InspectorControls>
            <div>
            <strong>Select a font color:</strong>
        <ColorPalette
        value={fontColor}
        onChange={onTextColorChange}
        />
        </div>
        </InspectorControls>,
        <RichText
        tagName="h2"
        className="content"
        value={attributes.textString}
        onChange={onTextChange}
        placeholder="Enter your text here!"
        style={{ color: fontColor }}
        />
    ]);
    }, // end edit props

    save(props) {

        const { attributes, className } = props;
        const { fontColor } = props.attributes;

        return (
            <h2 class="content" style={{ color: fontColor }}>{attributes.textString}</h2>
    );
    } // end save props
});