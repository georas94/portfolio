import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['input','results','error','loading'];

    async initialize() {
        await this.setupDynamsoft();
        this.initFileInput();
    }

    async setupDynamsoft() {
        try {
            // on teste window.Dynamsoft ; le LicenseManager fait partie du bundle
            await window.Dynamsoft.License.LicenseManager.initLicense(
                document.querySelector('meta[name="dynamsoft-license"]').content
            );
            // on charge le moteur WASM (empaqueté dans dbr.bundle.js)
            await window.Dynamsoft.Core.CoreModule.loadWasm(['dbr']);
            this.cvRouter = await window.Dynamsoft.CVR.CaptureVisionRouter.createInstance();
        }
        catch (e) {
            this.showError('Erreur d’initialisation : ' + e.message);
        }
    }

    initFileInput() {
        this.inputTarget.addEventListener('change', async (e) => {
            this.clearResults();
            this.toggleLoading(true);

            try {
                const file = e.target.files[0];
                const result = await this.cvRouter.capture(file, "ReadBarcodes_ReadRateFirst");
                this.handleScanResults(result, file);
            } catch (error) {
                this.showError("Erreur lors de la lecture : " + error.message);
            } finally {
                this.toggleLoading(false);
            }
        });
    }

    handleScanResults(result, file) {
        const resultsContainer = this.resultsTarget.querySelector('#results-content');
        resultsContainer.innerHTML = '';

        // if (file.length > 0) {
        //     resultsContainer.innerText += \n${file.name}:\n;
        // }

        console.log(result.items);
        for (let item of result.items) {
            if (item.type !== Dynamsoft.Core.EnumCapturedResultItemType.CRIT_BARCODE) {
                continue;
            }
            resultsContainer.innerText += item.text + "\n";
        }
        if (!result.items.length) resultsContainer.innerText += "Aucun code-barres détecté\n";

        // const validBarcodes = result.items.filter(item =>
        //     item.type === Dynamsoft.Core.EnumCapturedResultItemType.CRIT_BARCODE
        // );
        // console.log(result)
        // console.log(result.items)
        // return;

        // validBarcodes.forEach(barcode => {
        //     const div = document.createElement('div');
        //     div.className = 'p-3 bg-white rounded border flex items-center justify-between';
        //     div.innerHTML =
        //         <div>
        //             <span class="font-medium">${barcode.format}</span>
        //             <span class="text-gray-600 ml-2">${barcode.text}</span>
        //         </div>
        //         <i class="fas fa-check text-green-500"></i>
        //     ;
        //     resultsContainer.appendChild(div);
        // });

        this.resultsTarget.classList.remove('hidden');
    }

    toggleLoading(show) {
        this.loadingTarget.classList.toggle('hidden', !show);
    }

    showError(message) {
        this.errorTarget.textContent = message;
        this.errorTarget.classList.remove('hidden');
    }

    clearResults() {
        this.resultsTarget.classList.add('hidden');
        this.errorTarget.classList.add('hidden');
        this.resultsTarget.querySelector('#results-content').innerHTML = '';
    }
}