import ClientHttpRequest from "../http/client.http.request";

class ComponentEssayTextOption extends HTMLElement {
    /**
     * Construct.
     */
    constructor() {
        super();

        this.value = null;
        this.endpoint = null;
        this.inputName = null;
        this.client = ClientHttpRequest;
    }

    /**
     *
     * @param {string} value
     */
    set setValue(value) {
        this.value = value;
    }

    /**
     *
     * @param {string} value
     */
    set setEndpoint(value) {
        this.endpoint = value;
    }

    /**
     *
     * @param {string} value
     */
    set setInputName(value) {
        this.inputName = value;
    }

    /**
     * Callback Initial trigger
     */
    connectedCallback() {
        this.setValue = this.dataset.value;
        this.setEndpoint = this.dataset.endpoint;
        this.setInputName = this.dataset.name;

        // Create Elements
        const input = this.#createTextInput();
        const button = this.#createSubmitInput();

        // Set Attributes for Elements
        this.#createInputAttributes(input);
        this.#createButtonAttributes(button);

        // Append elements to component
        this.#appendInputToComponent(input);
        this.#appendButtonToComponent(button);
    }

    /**
     *
     * @returns {HTMLInputElement}
     */
    #createTextInput() {
        return document.createElement('input');
    }

    /**
     *
     * @returns {HTMLButtonElement}
     */
    #createSubmitInput() {
        return document.createElement('button');
    }

    /**
     *
     * @param {HTMLInputElement} input
     * @returns {HTMLInputElement}
     */
    #createInputAttributes(input) {
        input.type = 'text';
        input.value = this.value;
        input.name = this.inputName;
        input.id = this.inputName;

        // Register Events
        input.addEventListener('keyup', this.#inputTextKeywordHandler);

        return input;
    }

    /**
     *
     * @param {HTMLButtonElement} button
     * @returns {HTMLButtonElement}
     */
    #createButtonAttributes(button) {
        button.innerText = 'Save';
        button.addEventListener('click', this.#buttonClickHandler.bind(this));

        return button;
    }

    /**
     *
     * @param {HTMLInputElement} input
     */
    #appendInputToComponent(input) {
        this.appendChild(input);
    }

    /**
     *
     * @param {HTMLButtonElement} button
     */
    #appendButtonToComponent(button) {
        this.appendChild(button);
    }

    /**
     *
     * @param {InputEvent} e
     */
    #inputTextKeywordHandler({target}) {
        this.setValue = target.value;
    }

    /**
     *
     * @param {InputEvent} e
     * @returns {Promise<void>}
     */
    async #buttonClickHandler(e) {
        const input = document.getElementById(this.inputName);
        const value = input.value;

        await this.#requestSaveValue(value, e.target);
    }

    /**
     *
     * @param {HTMLButtonElement} button
     * @param {boolean} state
     */
    #buttonStateDisabled(button, state) {
        button.disabled = state;
    }

    /**
     *
     * @param value
     * @param {HTMLButtonElement} button
     * @returns {Promise<void>}
     */
    async #requestSaveValue(value, button) {
        const headers = new Headers();
        headers.append("Content-Type", "application/json");

        try {
            this.#buttonStateDisabled(button, true);

            const request = await ClientHttpRequest.post(
                'http://edupro.test/wp-json/essay/v1',
                this.endpoint,
                JSON.stringify({value}),
                headers,
            );

            const response = await request.json();

            this.#requestResultMessage.call(this, response?.result || 'Field has been success updated');
        } catch (e) {
            console.log(e);
        }

        this.#buttonStateDisabled(button, false);
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

export default ComponentEssayTextOption;
