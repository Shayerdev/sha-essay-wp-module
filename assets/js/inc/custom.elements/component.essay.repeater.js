import ClientHttpRequest from "../http/client.http.request";

class ComponentEssayRepeater extends HTMLElement {
    constructor() {
        super();

        this.urlHttpClient = 'http://edupro.test/wp-json/essay/v1';
        this.columns = null;
        this.name = null;
        this.value = null;
        this.endpoint = null;

        this.httpClient = ClientHttpRequest;
    }

    /**
     *
     * @param {string} value
     */
    set setColumns(value) {
        this.columns = JSON.parse(value);
    }

    /**
     *
     * @param {string} value
     */
    set setName(value) {
        this.name = value;
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
     * @param {string} value
     */
    set setEndpoint(value) {
        this.endpoint = value;
    }

    async connectedCallback() {
        this.setName = this.dataset.name;
        this.setColumns = this.dataset.columns;
        this.setEndpoint = this.dataset.endpoint;

        const {success, data} = await this.#queryData();

        this.#buildListComponent(success, data);
    }

    /**
     *
     * @return {Promise<any>}
     */
    async #queryData() {
        const headers = new Headers();
        headers.append("Content-Type", "application/json");

        const request = await this.httpClient.get(this.urlHttpClient, this.endpoint);
        return await request.json();
    }

    /**
     *
     * @param {boolean} status
     * @param {object[]} data
     */
    #buildListComponent(status, data) {
        if (!data)
            return;

        const listElement = document.createElement('component-essay-repeater-list');
        const listElementWithItems = this.#buildListItem(listElement, data);

        this.appendChild(listElementWithItems);
    }

    /**
     *
     * @param {Element} listElement
     * @param {object[]} data
     * @return Element;
     */
    #buildListItem(listElement, data) {
        data.forEach(item => {
            const itemElement = document.createElement('component-essay-repeater-list-item');

            // Set Data item
            itemElement.dataset.fields = JSON.stringify(this.columns);
            itemElement.dataset.value = JSON.stringify(item);

            listElement.appendChild(itemElement);
        });

        return listElement;
    }
}

export default ComponentEssayRepeater;
