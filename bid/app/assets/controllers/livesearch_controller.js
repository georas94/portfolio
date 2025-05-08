import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['input', 'results', 'referenceFilter', 'referenceLoader', 'clearButton'];
    static values = {
        url: String,
        delay: { type: Number, default: 200 },
        referencesUrl: String
    };

    connect() {
        this.timeout = null;
        this.inputTarget.addEventListener('input', () => this.onInput());
        this.loadReferences();
    }

    async loadReferences() {
        try {
            this.referenceLoaderTarget.classList.remove('hidden');
            const response = await fetch(this.referencesUrlValue);

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            const data = await response.json();

            // Vérification de la structure de réponse
            if (!Array.isArray(data?.decree_ids)) {
                throw new Error('Format de réponse inattendu');
            }

            this.referenceFilterTarget.innerHTML = `
            <option value="">Tous les documents</option>
            ${data.decree_ids.map(ref => `
                <option value="${ref}">Décret ${ref}</option>
            `).join('')}
        `;

        } catch (e) {
            console.error('Erreur de chargement des références', e);
            this.referenceFilterTarget.innerHTML = `
            <option value="">Erreur de chargement</option>
        `;
        } finally {
            this.referenceLoaderTarget.classList.add('hidden');
        }
    }

    onInput() {
        clearTimeout(this.timeout);
        const q = this.inputTarget.value.trim();

        // Gestion du bouton clear
        this.clearButtonTarget.classList.toggle('opacity-0', !q);

        // Recherche avec délai
        this.timeout = setTimeout(() => {
            if (q) this.search(q);
        }, this.delayValue);
    }

    clearSearch() {
        this.inputTarget.value = '';
        this.clearButtonTarget.classList.add('opacity-0');
        this.resultsTarget.innerHTML = '';
    }

    async search(query) {
        try {
            const reference = this.referenceFilterTarget.value;
            let url = `${this.urlValue}?q=${encodeURIComponent(query)}`;
            if (reference) url += `&reference=${encodeURIComponent(reference)}`;

            const response = await fetch(url);
            const data = await response.json();

            // Extraction des résultats hiérarchiques
            const hits = data.results || [];
            this.renderResults(hits, query);
        } catch (e) {
            this.resultsTarget.innerHTML = `
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mt-4">
          <i class="fas fa-exclamation-triangle mr-2"></i>Erreur lors de la recherche
        </div>
      `;
        }
    }

    renderResults(results, query) {
        if (!results.length) {
            this.resultsTarget.innerHTML = `
            <div class="bg-blue-100 text-blue-700 p-4 rounded-xl mt-4">
                <i class="fas fa-search-minus mr-2"></i>Aucun résultat pour « ${query} »
            </div>`;
            return;
        }
        const resultsHTML = results.map(result => `
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow mb-4">
            <div class="flex justify-between items-start mb-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">
                            ${result.decree_id}
                        </span>
                        <span class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">
                            Article ${result.article_number}
                        </span>
                        <span class="hidden md:inline-block bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                            Section : ${result.section_title}
                        </span>
                    </div>
                </div>
            </div>
            <div class="prose prose-sm max-w-none">
                ${result.highlight.map(fragment => `
                    <p class="bg-yellow-50 p-3 rounded-lg my-2">${fragment}</p>
                `).join('')}
            </div>
        </div>
    `).join('');

        this.resultsTarget.innerHTML = `
        <div class="mb-6 text-gray-600">
            ${results.length} résultat${results.length > 1 ? 's' : ''} pour « ${query} »
        </div>
        ${resultsHTML}
    `;
    }
}