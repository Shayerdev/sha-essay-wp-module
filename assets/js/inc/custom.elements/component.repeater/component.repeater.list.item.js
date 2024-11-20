class ComponentRepeaterListItem extends HTMLElement {
    constructor() {
        super();

        this.value = null;
        this.fields = null;
    }

    /**
     *
     * @param {string} value
     */
    set setValue(value) {
        this.value = JSON.parse(value);
    }

    /**
     *
     * @param {string} fields
     */
    set setFields(fields) {
        this.fields = JSON.parse(fields);
    }

    connectedCallback() {
        this.setValue = this.dataset.value;
        this.setFields = this.dataset.fields;

        this.#componentFieldProvider();
    }

    #componentFieldProvider() {
        Object.entries(this.fields).forEach(item => {
            const field = item[0];
            const fieldAttr = item[1];

            const fieldWrapperElement = this.#createFieldElement(field, fieldAttr.type, fieldAttr);

            this.appendChild(fieldWrapperElement);
        });
    }

    /**
     *
     * @param {string} name
     * @param {string} type
     * @param {object} fieldData
     * @return {Element}
     */
    #createFieldElement(name, type, fieldData) {
        const componentFieldName = `component-essay-field-${type}`
        const fieldElement =  document.createElement(componentFieldName);

        // Set Attributes
        fieldElement.dataset.rel = name;
        fieldElement.dataset.field = fieldData.field;

        if (this.value[fieldData.field]) {
            fieldElement.dataset.value = this.value[fieldData.field]
        }

        return fieldElement;
    }
}

export default ComponentRepeaterListItem;
