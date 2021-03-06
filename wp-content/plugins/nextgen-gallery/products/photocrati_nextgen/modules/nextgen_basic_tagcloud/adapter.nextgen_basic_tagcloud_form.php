<?php

class A_NextGen_Basic_Tagcloud_Form extends Mixin_Display_Type_Form
{
	function get_display_type_name()
	{
		return NGG_BASIC_TAGCLOUD;
	}


    function _get_field_names()
    {
        return array(
            'nextgen_basic_tagcloud_number',
            'nextgen_basic_tagcloud_display_type'
        );
    }

    function _render_nextgen_basic_tagcloud_number_field($display_type)
    {
        return $this->_render_number_field(
            $display_type,
            'number',
            __('Maximum number of tags', 'nggallery'),
            $display_type->settings['number']
        );
    }

    function _render_nextgen_basic_tagcloud_display_type_field($display_type)
    {
        $types = array();
        $skip_types = array(
            'photocrati-nextgen_basic_tagcloud',
            'photocrati-nextgen_basic_singlepic'
        );
        $mapper = $this->object->get_registry()->get_utility('I_Display_Type_Mapper');
        $display_types = $mapper->find_all();
        foreach ($display_types as $dt) {
            if (in_array($dt->name, $skip_types)) continue;
            $types[$dt->name] = str_replace('NextGEN Basic ', '', $dt->title);
        }

        return $this->_render_select_field(
            $display_type,
            'display_type',
            __('Display type', 'nggallery'),
            $types,
            $display_type->settings['display_type'],
            __('The display type that the tagcloud will point its results to', 'nggallery')
        );
    }
}
