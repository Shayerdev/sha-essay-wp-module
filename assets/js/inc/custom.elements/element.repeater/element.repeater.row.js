class ElementRepeaterRow extends HTMLElement {
    constructor() {
        super();

        this.value = null;
        this.columns = null;
    }

    set setValue(value) {
        this.value = JSON.parse(value);
    }

    set setColumns(value) {
        this.columns = JSON.parse(value);
    }

    connectedCallback() {
        this.setValue = this.dataset.value;
        this.setColumns = this.dataset.column;

        this.#createRow();
    }

    #createRow() {
        this.columns && this.columns.forEach(column => {
            const inputElement = this.#createInputElement();
            const inputElementWithValue = this.#appendInputValue(inputElement, column);

            this.appendChild(inputElementWithValue);
        });

        const buttonDeleteRow = this.#createDeleteElement();
        this.appendChild(buttonDeleteRow);
    }

    /**
     *
     * @returns {HTMLInputElement}
     */
    #createInputElement() {
        return document.createElement('input');
    }

    /**
     *
     * @param {HTMLInputElement} input
     * @param {string} columnName
     */
    #appendInputValue(input, columnName) {
        input.value = this.value[columnName];
        input.dataset.column = columnName;

        return input;
    }

    /**
     *
     * @returns {HTMLButtonElement}
     */
    #createDeleteElement() {
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Remove';

        // Register events
        deleteButton.addEventListener('click', () => this.remove());

        return deleteButton;
    }
}

export default ElementRepeaterRow;
