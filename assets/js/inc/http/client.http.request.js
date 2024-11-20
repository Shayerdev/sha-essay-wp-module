class ClientHttpRequest
{
    /**
     *
     * @param {string} url
     * @param {string} endpoint
     * @param {object} data
     * @param {Headers} headers
     * @returns {Promise<Response>}
     */
    static async post(url, endpoint, data, headers){
        return await fetch(`${url}/${endpoint}`, {
            method: 'POST',
            body: data,
            headers: headers,
        });
    }

    /**
     *
     * @param {string} url
     * @param {string} endpoint
     * @param {Headers} headers
     * @return {Promise<Response>}
     */
    static async get(url, endpoint, headers){
        return await fetch(`${url}/${endpoint}`, {
            method: 'GET',
            headers: headers,
        });
    }
}

export default ClientHttpRequest;
