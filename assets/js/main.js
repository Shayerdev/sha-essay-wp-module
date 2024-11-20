import ComponentEssayTextOption from "./inc/custom.elements/component.essay.text.option";
import ComponentEssayAlertHttp from "./inc/custom.elements/component.essay.alert.http";
import ComponentEssayRepeaterOption from "./inc/custom.elements/component.essay.repeater.option";
import ElementRepeaterRow from "./inc/custom.elements/element.repeater/element.repeater.row";
import ElementRepeaterRowCreate from "./inc/custom.elements/element.repeater/element.repeater.row.create";
import ComponentEssayRepeater from "./inc/custom.elements/component.essay.repeater";
import ComponentRepeaterList from "./inc/custom.elements/component.repeater/component.repeater.list";
import ComponentRepeaterListItem from "./inc/custom.elements/component.repeater/component.repeater.list.item";
import ComponentFieldHidden from "./inc/custom.elements/component.field/component.field.hidden";
import ComponentFieldCheckbox from "./inc/custom.elements/component.field/component.field.checkbox";
import ComponentFieldText from "./inc/custom.elements/component.field/component.field.text";
import ComponentFieldSelect from "./inc/custom.elements/component.field/component.field.select";

document.addEventListener('DOMContentLoaded', () => {
    [{
        name: 'component-essay-text-option',
        registrar: ComponentEssayTextOption,
        options: {},
    }, {
        name: 'component-essay-alert-http',
        registrar: ComponentEssayAlertHttp,
        options: {},
    }, {
        name: 'component-essay-repeater-option',
        registrar: ComponentEssayRepeaterOption,
        options: {},
    }, {
        name: 'component-essay-repeater-row',
        registrar: ElementRepeaterRow,
        options: {},
    }, {
        name: 'component-essay-repeater-row-create',
        registrar: ElementRepeaterRowCreate,
        options: {},
    }, {
        name: 'component-essay-repeater',
        registrar: ComponentEssayRepeater,
        options: {},
    }, {
        name: 'component-essay-repeater-list',
        registrar: ComponentRepeaterList,
        options: {},
    }, {
        name: 'component-essay-repeater-list-item',
        registrar: ComponentRepeaterListItem,
        options: {},
    }, {
        name: 'component-essay-field-texthidden',
        registrar: ComponentFieldHidden,
        options: {},
    }, {
        name: 'component-essay-field-checkbox',
        registrar: ComponentFieldCheckbox,
        options: {},
    }, {
        name: 'component-essay-field-text',
        registrar: ComponentFieldText,
        options: {},
    }, {
        name: 'component-essay-field-select',
        registrar: ComponentFieldSelect,
        options: {},
    }].forEach(({name, registrar, options}) => {
        customElements.define(name, registrar, options);
    })
})
