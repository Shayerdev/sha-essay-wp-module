import ClientHttpRequest from "../../http/client.http.request";

class ElementRepeaterRowCreate extends HTMLElement {
    constructor() {
        super();

        this.columns = null;
        this.endpoint = null;
        this.client = ClientHttpRequest;
    }

    set setColumns(value) {
        this.columns = JSON.parse(value);
    }

    set setEndpoint(value) {
        this.endpoint = value;
    }

    connectedCallback () {
        this.setColumns = this.dataset.column;
        this.setEndpoint = this.dataset.endpoint;

        this.#createRow();
    }

    #createRow() {
        this.columns && this.columns.forEach(column => {
            const inputElement = this.#createInputElement();
            const inputElementWIthType = this.#setTypeInput(inputElement, column);

            this.appendChild(inputElementWIthType);
        });

        // Create Buttons
        const buttonAppendRow = this.#createAppendElement();
        this.appendChild(buttonAppendRow);

        const buttonSaveRow = this.#createSaveElement();
        this.appendChild(buttonSaveRow);
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
     *
     * @return {HTMLInputElement}
     */
    #setTypeInput(input, columnName) {
        input.dataset.column = columnName;
        input.placeholder = columnName.replaceAll('_', ' ');

        return input;
    }

    /**
     *
     * @returns {HTMLButtonElement}
     */
    #createAppendElement() {
        const button = document.createElement('button');
        button.textContent = 'Add';

        // Register events
        button.addEventListener('click', this.#actionCreateRow.bind(this));

        return button;
    }

    /**
     *
     * @returns {HTMLButtonElement}
     */
    #createSaveElement() {
        const button = document.createElement('button');
        button.textContent = 'Save';

        // Register events
        button.addEventListener('click', this.#actionSaveRow.bind(this));

        return button;
    }

    /**
     *
     * @param {MouseEvent} event
     */
    #actionCreateRow(event) {
        const rowsContainer = this.#getRowsContainer();
        const buildDataForRow = this.#buildDataByForm();

        const rowElement = this.#createRowElement(buildDataForRow);
        this.#appendRowElement(rowElement, rowsContainer);
    }

    /**
     *
     * @param {MouseEvent} event
     */
    async #actionSaveRow(event) {
        const data = this.#buildDataByRows();
        const request = await this.#requestSaveValue(data);

        this.#requestResultMessage.call(this, request?.result || 'Field has been success updated');
    }

    /**
     * @return {Element}
     */
    #getRowsContainer() {
        const parent = this.parentNode;
        return parent.querySelector('.repeater-rows-wrapper');
    }

    /**
     *
     * @return {object}
     */
    #buildDataByForm() {
        const inputs = this.querySelectorAll('input');
        let data = {};

        inputs && inputs.forEach(input => {
            data[input.dataset.column] = input.value

            input.value = null;
        });

        return data;
    }

    /**
     *
     * @param {object} value
     * @return Element
     */
    #createRowElement(value) {
        const rowElement = document.createElement('component-essay-repeater-row');

        // Set data
        rowElement.dataset.column = JSON.stringify(this.columns);
        rowElement.dataset.value = JSON.stringify(value);

        return rowElement;
    }

    /**
     *
     * @param {Element} element
     * @param {Element} container
     */
    #appendRowElement(element, container) {
        container.appendChild(element);
    }

    /**
     *
     * @return {object[]}
     */
    #buildDataByRows() {
        let data = [];
        const parent = this.parentNode;
        const rows = parent.querySelectorAll('component-essay-repeater-row');

        rows && rows.forEach(row => {
            const valueRow = row.dataset.value;

            data.push(JSON.parse(valueRow));
        })

        return data;
    }

    /**
     *
     * @param data
     */
    async #requestSaveValue(data) {
        const headers = new Headers();
        headers.append("Content-Type", "application/json");

        try {

            const request = await ClientHttpRequest.post(
                'http://edupro.test/wp-json/essay/v1',
                this.endpoint,
                JSON.stringify(data),
                headers,
            );

            return await request.json();
        } catch (e) {
            console.log(e);
        }
    }

    /**
     *
     * @param {string} responseMessage
     */
    #requestResultMessage(responseMessage) {
        const alertResponse = document.createElement('component-essay-alert-http');
        alertResponse.setAttribute('data-message', responseMessage);

        this?.parentElement.appendChild(alertResponse);
    }
}

export default ElementRepeaterRowCreate;
