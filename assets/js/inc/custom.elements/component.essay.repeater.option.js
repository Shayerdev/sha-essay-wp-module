class ComponentEssayRepeaterOption extends HTMLElement {
    constructor() {
        super();

        this.columns = null;
        this.name = null;
        this.value = null;
        this.endpoint = null;
    }

    set setColumns(value) {
        this.columns = value;
    }

    set setName(value) {
        this.name = value;
    }

    set setValue(value) {
        this.value = JSON.parse(value);
    }

    set setEndpoint(value) {
        this.endpoint = value;
    }

    connectedCallback() {
        this.setName = this.dataset.name;
        this.setColumns = this.dataset.columns;
        this.setValue = this.dataset.value;
        this.setEndpoint = this.dataset.endpoint;

        // Create Exist Rows
        const wrapperRows = this.#createRowsWrapper();
        this.#createRows(wrapperRows);

        // Create Form for create rows
        this.#createForm();
    }

    /**
     *
     * @returns {HTMLElement}
     */
    #createRowsWrapper() {
        const element = document.createElement('div');
        element.classList.add('repeater-rows-wrapper');

        this.appendChild(element);
        return element;
    }

    /**
     *
     * @param {HTMLElement} elementWrapper
     */
    #createRows(elementWrapper) {
        this.value && this.value.forEach(row => this.#createRow(row, elementWrapper));
    }

    /**
     *
     * @param {object} rowData
     * @param {HTMLElement} elementWrapper
     */
    #createRow(rowData, elementWrapper) {
        const row = document.createElement('component-essay-repeater-row');
        row.setAttribute('data-column', this.columns);
        row.setAttribute('data-value', JSON.stringify(rowData));

        elementWrapper.appendChild(row);
    }

    #createForm() {
        const form = document.createElement('component-essay-repeater-row-create');
        form.setAttribute('data-column', this.columns);
        form.setAttribute('data-endpoint', this.endpoint);

        this.appendChild(form);
    }
}

export default ComponentEssayRepeaterOption;
