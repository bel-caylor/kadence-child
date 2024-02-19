const { addFilter } = wp.hooks;
const { BlockControls, RichTextToolbarButton } = wp.blockEditor;
// const { ToolbarButton } = wp.components;

//Registor Custom Format
wp.richText.registerFormatType('sermonBlank/sermon-blank', {
    title: 'Sermon Blank',
    tagName: 'span',
    className: 'sermon-blank',
});

const CustomButton = (BlockEdit) => {
    return (props) => {
        // Only add the button to the paragraph block
        if (props.name !== 'core/paragraph') {
            return <BlockEdit {...props} />;
        }

        return (
            <>
                <BlockControls>
                    <RichTextToolbarButton 
                        icon="download"
                        label="Custom Button"
                        onClick={() => {
                            const { replace, insert, create, toHTMLString, slice, applyFormat } = wp.richText;
                            const { getSelectedBlock } = wp.data.select('core/block-editor');
                        
                            const selectedBlock = getSelectedBlock();
                            // console.log(selectedBlock);
                            if (selectedBlock && selectedBlock.attributes.content) {
                                let start = wp.data.select('core/block-editor').getSelectionStart();
                                let end = wp.data.select('core/block-editor').getSelectionEnd();
                                start = start.offset;
                                end = end.offset;

                                const richTextValue = create({ html: selectedBlock.attributes.content });
                                
                                // Apply the format to the selected text
                                const modifiedValue = applyFormat(
                                    richTextValue,
                                    {
                                        type: 'sermonBlank/sermon-blank',
                                    },
                                    start,
                                    end
                                );
                            
                                // Convert the modified value back to HTML
                                const modifiedContent = toHTMLString({ value: modifiedValue });
                            
                                // Update the block's content
                                wp.data.dispatch('core/block-editor').updateBlockAttributes(
                                    selectedBlock.clientId,
                                    { content: modifiedContent }
                                );


                            }
                        }}
                    />
                </BlockControls>
                <BlockEdit {...props} />
            </>
        );
    };
};

addFilter('editor.BlockEdit', 'your-namespace', CustomButton);