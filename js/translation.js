
const { BlockControls, RichTextToolbarButton } = wp.blockEditor;
const { registerFormatType, toggleFormat } = wp.richText;
const { ToolbarGroup, ToolbarButton } = wp.components;
const { useSelect } = wp.data;

const TranslationButton = ( { isActive, onChange, value } ) => {
    const { postType } = useSelect( ( select ) => {
        return { postType: select( 'core/editor' ).getCurrentPostType() };
      }, [] );

    if ( postType === 'song' ) {
        return (
            <BlockControls>
                <ToolbarGroup>
                    <ToolbarButton
                        icon="translation"
                        title="Translation"
                        onClick={ () => {
                            onChange(
                                toggleFormat( value, {
                                    type: 'my-custom-format/translation',
                                } )
                            );
                        } }
                        isActive={ isActive }
                    />
                </ToolbarGroup>
            </BlockControls>
        );
    } else {
        return null;
    }
    };
    
registerFormatType( 'my-custom-format/translation', {
    title: 'Translation',
    tagName: 'span',
    className: 'translation',
    edit: TranslationButton,
} );