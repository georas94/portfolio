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
        this.iframe.src = `${this.urlValue}#page=${this.pageValue}`
        this.modal.classList.remove('hidden')
    }

    close() {
        this.modal.classList.add('hidden')
        this.iframe.src = ''
    }
}
