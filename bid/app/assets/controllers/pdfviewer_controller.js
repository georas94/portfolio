import {Controller} from "@hotwired/stimulus"

export default class extends Controller {
    static values = {
        url: String,
        page: Number
    }

    connect() {
        this.modal = document.getElementById('pdfModal')
        this.iframe = document.getElementById('pdfIframe')
        this.closeButton = this.modal.querySelector('[data-action="pdfviewer#close"]')
    }

    open() {
        const cleanUrl = this.urlValue.split('#')[0]; // supprime tout ce qui est après #
        this.iframe.src = `${cleanUrl}#page=${this.pageValue}`;
        this.modal.classList.remove('hidden')
    }

    close() {
        this.modal.classList.add('hidden')
        this.iframe.src = ''
    }
}
