const { BlockControls, useBlockEditorState } = wp.blockEditor;
const { registerFormatType, toggleFormat } = wp.richText;
const { ToolbarGroup, ToolbarButton } = wp.components;
const { useSelect } = wp.data;

const TranslationButton = ( { isActive, onChange, value } ) => {
  const { postType, selectedBlock } = useSelect( ( select ) => {
    return {
      postType: select( 'core/editor' ).getCurrentPostType(),
      selectedBlock: select( 'core/block-editor' ).getSelectedBlock(),
    };
  }, [] );

  console.log(selectedBlock);

  if ( postType === 'song' && selectedBlock.name === 'core/paragraph' ) {
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
