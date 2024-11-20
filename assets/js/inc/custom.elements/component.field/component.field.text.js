class ComponentFieldText extends HTMLElement {
    constructor() {
        super();

        this.fieldType = null;
        this.fieldName = null;
        this.fieldValue = null;
    }

    /**
     *
     * @param value
     */
    set setFieldType(value) {
        this.fieldType = value;
    }

    /**
     *
     * @param value
     */
    set setFieldName(value) {
        this.fieldName = value;
    }

    /**
     *
     * @param value
     */
    set setFieldValue(value) {
        this.fieldValue = value;
    }

    connectedCallback() {
        this.setFieldName = this.dataset.field;
        this.setFieldType = this.dataset.type;
        this.setFieldValue = this.dataset?.value || null;

        this.#createTextElement();
    }

    #createTextElement() {
        const element = document.createElement('input');

        // Set Attribute
        element.setAttribute('type', 'text');
        element.setAttribute('name', this.fieldName);
        element.setAttribute('value', this.fieldValue);

        this.append(element);
    }
}

export default ComponentFieldText;
