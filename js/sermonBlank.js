
const { BlockControls, useBlockEditorState } = wp.blockEditor;
const { registerFormatType, toggleFormat } = wp.richText;
const { ToolbarGroup, ToolbarButton } = wp.components;
const { useSelect } = wp.data;

const sermonBlankButton = ( { isActive, onChange, value } ) => {
  const { postType, selectedBlock } = useSelect( ( select ) => {
    return {
      postType: select( 'core/editor' ).getCurrentPostType(),
      selectedBlock: select( 'core/block-editor' ).getSelectedBlock(),
    };
  }, [] );

  console.log(selectedBlock);

  if ( postType === 'sermon' && ( selectedBlock.name === 'core/paragraph' || selectedBlock.name === 'core/list-item')) {
    return (
      <BlockControls>
        <ToolbarGroup>
          <ToolbarButton
            icon="button"
            title="Sermon Blank"
            onClick={ () => {
              onChange(
                toggleFormat( value, {
                  type: 'my-custom-format/sermon-blank',
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

registerFormatType( 'my-custom-format/sermon-blank', {
  title: 'Sermon Blank',
  tagName: 'span',
  className: 'sermon-blank',
  edit: sermonBlankButton,
} );

