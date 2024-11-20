class ComponentEssayAlertHttp extends HTMLElement {
    constructor() {
        super();

        this.timeoutRemove = 3000;
    }

    connectedCallback() {
        this.innerText = this.dataset.message;

        setTimeout(() => this.remove(), this.timeoutRemove);
    }
}

export default ComponentEssayAlertHttp;
