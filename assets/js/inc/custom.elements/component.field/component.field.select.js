class ComponentFieldSelect extends HTMLElement {
    constructor() {
        super();

        this.data = null;
        this.fieldRel = null;
        this.fieldName = null;
        this.fieldValue = null;
    }

    /**
     *
     * @param value
     */
    set setFieldRel(value) {
        this.fieldRel = value;
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

    /**
     *
     * @param value
     */
    set setListValue(value) {
        this.data = value;
    }

    connectedCallback() {
        this.setFieldName = this.dataset.field;
        this.setFieldRel = this.dataset.rel;
        this.setFieldValue = this.dataset?.value || null;
        this.setListValue = window?.['essay_'.concat(this.fieldRel)] || null;

        this.#createSelectElement();
    }

    #createSelectElement() {
        const selectElement = document.createElement('select');

        // Set Attribute
        selectElement.setAttribute('name', this.fieldName);
        selectElement.setAttribute('value', this.fieldValue);

        const defaultOption = this.#createDefaultOptionElement();
        selectElement.appendChild(defaultOption);

        const dataSelectWithOptions = this.#createDataOptionElements(selectElement);

        this.append(dataSelectWithOptions);
    }

    /**
     *
     * @return {Element}
     */
    #createDefaultOptionElement() {
        const options = document.createElement('option');
        options.textContent = 'Product Type';

        return options;
    }

    /**
     *
     * @param {Element} select
     * @return {Element}
     */
    #createDataOptionElements(select) {
        if (!this.data) {
            return null;
        }

        this.data.forEach(item => {
            const optionElement = document.createElement('option');

            // Set Data
            optionElement.setAttribute('value', item.id);
            optionElement.textContent = item.label;

            // Check active state
            item?.fieldValue && this.fieldValue.includes(item.id) && optionElement.setAttribute('selected', true);

            select.appendChild(optionElement);
        });

        return select;
    }
}

export default ComponentFieldSelect;
