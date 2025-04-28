import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['input', 'results', 'referenceFilter', 'referenceLoader', 'clearButton'];
    static values = { url: String, delay: { type: Number, default: 200 }, referencesUrl: String };

    connect() {
        this.timeout = null;
        this.loadReferences();
        this.inputTarget.addEventListener('input', () => this.onInput());
    }

    async loadReferences() {
        try {
            this.referenceLoaderTarget.classList.remove('hidden'); // montrer le spinner
            const response = await fetch(this.referencesUrlValue);
            const references = await response.json();
            // Ajouter dynamiquement les options
            this.referenceFilterTarget.innerHTML = `
        <option value="">Tous les documents</option>
        ${references.map(ref => `<option value="${ref}">Décret ${ref}</option>`).join('')}
      `;
        } catch (e) {
            console.log(e);
            console.error('Erreur de chargement des références', e);
            this.referenceFilterTarget.innerHTML = `<option value="">Erreur de chargement</option>`;
        } finally {
            this.referenceLoaderTarget.classList.add('hidden'); // cacher le spinner
        }
    }

    onInput() {
        clearTimeout(this.timeout);
        const q = this.inputTarget.value.trim();

        // Gestion visuelle du bouton clear
        if (q) {
            this.clearButtonTarget.classList.remove('opacity-0');
            this.clearButtonTarget.classList.add('opacity-100');
        } else {
            this.clearButtonTarget.classList.remove('opacity-100');
            this.clearButtonTarget.classList.add('opacity-0');
        }

        if (q === '') {
            this.resultsTarget.innerHTML =
                `<p class="text-center text-gray-500 mt-6">Commencez à taper pour lancer la recherche.</p>`;
            return;
        }
        this.showSkeletonLoading();
        this.timeout = setTimeout(() => this.search(q), this.delayValue);
    }

    clearSearch() {
        this.inputTarget.value = '';
        this.clearButtonTarget.classList.remove('opacity-100');
        this.clearButtonTarget.classList.add('opacity-0');
        this.resultsTarget.innerHTML = `
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">✨ Saisissez une requête pour commencer</div>
        </div>
    `;
    }

    showSkeletonLoading() {
        this.resultsTarget.innerHTML = `
    <div class="space-y-4 mt-6">
      ${Array(3).fill('').map(() => `
        <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-md animate-pulse-slow">
          <div class="h-4 bg-gray-300 rounded w-1/2 mb-4"></div>
          <div class="space-y-2">
            <div class="h-3 bg-gray-300 rounded"></div>
            <div class="h-3 bg-gray-300 rounded w-5/6"></div>
            <div class="h-3 bg-gray-300 rounded w-2/3"></div>
          </div>
        </div>
      `).join('')}
    </div>
  `;
    }

    async search(query) {
        try {
            const reference = this.referenceFilterTarget.value;
            let url = `${this.urlValue}?q=${encodeURIComponent(query)}`;
            if (reference) url += `&reference=${encodeURIComponent(reference)}`;

            const response = await fetch(url);
            const hits = await response.json();

            if (!response.ok) throw new Error('Erreur réseau');
            this.renderResults(hits, query);
        } catch (e) {
            this.resultsTarget.innerHTML =
                `<div class="bg-red-100 text-red-700 p-4 rounded-lg mt-4">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Erreur lors de la recherche
                </div>`;
        }
    }

    renderResults(hits, query) {
        if (!hits || hits.length === 0) {
            this.resultsTarget.innerHTML =
                `<div class="bg-blue-100 text-blue-700 p-4 rounded-xl mt-4">
                    <i class="fas fa-search-minus mr-2"></i>Aucun résultat pour « ${query} »
                </div>`;
            return;
        }

        const countHeader = `
            <div class="flex justify-between items-center mb-4 text-gray-600">
                <span>${hits.length} résultat${hits.length > 1 ? 's' : ''}</span>
                <span class="text-sm">Score de pertinence</span>
            </div>`;

        this.resultsTarget.innerHTML = `
            ${countHeader}
            <div class="space-y-4">
                ${hits.map((hit, index) => this.createResultCard(hit, index)).join('')}
            </div>`;
    }

    createResultCard(hit, index) {
        const {
            reference,
            article,
            pages: { start: pageStart, end: pageEnd } = {},
            highlight = [],
            excerpt,
            source,
            score
        } = hit;

        return `
            <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm 
                        hover:shadow-md transition-shadow duration-200 
                        animate-fade-in-up" 
                 style="animation-delay: ${index * 50}ms">
                
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center space-x-4">
                        <div>
                            <h3 class="text-lg font-semibold text-primary">
                                ${reference || 'N/A'}
                            </h3>
                            ${article ? `
                                <span class="text-sm text-gray-500 mt-1 block">
                                    Article ${article}
                                </span>
                            ` : ''}
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        ${pageStart ? `
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs">
                                Page${pageEnd && pageEnd !== pageStart ? `s ${pageStart}-${pageEnd}` : ` ${pageStart}`}
                            </span>
                        ` : ''}
                        
                        <span class="bg-secondary text-white px-2 py-1 rounded-full text-xs">
                            Score ${score.toFixed(2)}
                        </span>
                    </div>
                </div>

                <div class="text-gray-700 space-y-2">
                    ${excerpt ? `<p class="text-sm leading-relaxed">${excerpt}</p>` : ''}
                    
                    ${highlight.length > 0 ? `
                        <div class="mt-2 space-y-1">
                            ${highlight.map(fragment =>
            `<div class="bg-yellow-100 p-2 rounded-lg text-sm">
                                    ${fragment.replace(/<mark>/g, '<span class="bg-yellow-300">')
                .replace(/<\/mark>/g, '</span>')}
                                </div>`
        ).join('')}
                        </div>
                    </div>
                    ` : ''}
             </div>
        `;
    }
}