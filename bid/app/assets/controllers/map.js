import 'leaflet/dist/leaflet.css';
import 'leaflet.markercluster/dist/MarkerCluster.css';
import 'leaflet.markercluster/dist/MarkerCluster.Default.css';
import L from 'leaflet';
import 'leaflet.markercluster';

delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
    iconUrl: require('leaflet/dist/images/marker-icon.png'),
    shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
});
document.addEventListener('DOMContentLoaded', () => {
    const mapElement = document.getElementById('map');
    if (!mapElement) return;

    let map = null;
    let markersCluster = null;
    let markerLookup = {};

    const initializeMap = () => {
        if (map) return;

        // Récupération des données
        const countryGeoJSON = JSON.parse(mapElement.dataset.geojson);
        const initialData = JSON.parse(mapElement.dataset.aos);
        const aoListUrl = mapElement.dataset.aoListUrl;

        // Initialisation de la carte
        map = L.map('map').setView([12.2383, -1.5616], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        // Ajout des frontières
        L.geoJSON(countryGeoJSON, {
            style: {
                color: 'rgb(22 163 74)',
                weight: 5,
                fill: false
            }
        }).addTo(map);

        // Configuration des clusters
        markersCluster = L.markerClusterGroup({
            maxClusterRadius: 60,
            iconCreateFunction: (cluster) => {
                const count = cluster.getChildCount();
                const size = count > 50 ? 'large' : count > 10 ? 'medium' : 'small';
                const colors = { large: '#E63946', medium: '#E9C46A', small: '#529D58' };

                return L.divIcon({
                    html: `
                        <svg width="44" height="44" viewBox="0 0 44 44">
                            <circle cx="22" cy="22" r="18" fill="${colors[size]}" opacity="0.7"/>
                            <circle cx="22" cy="22" r="14" fill="${colors[size]}"/>
                            <text x="22" y="26" font-size="14" fill="white" text-anchor="middle" font-weight="bold">${count}</text>
                        </svg>`,
                    className: 'marker-cluster-custom',
                    iconSize: L.point(44, 44)
                });
            }
        });

        // Création des marqueurs
        const secteurIcons = {
            'BTP': '🏗️', 'INF': '💻', 'ENV': '🌳', 'SANT': '🏥',
            'AGR': '🚜', 'EDU': '🏫', 'ENE': '💡', 'EAU': '💧'
        };

        const createMarker = (ao) => {
            const icon = secteurIcons[ao.secteurCode?.substring(0, 3)] || '📍';

            const marker = L.marker([ao.lat, ao.lng], {
                icon: L.divIcon({
                    html: `
                        <div class="relative w-9 h-9 flex items-center justify-center bg-transparent">
                            <div class="text-2xl">${icon}</div>
                        </div>`,
                    className: '',
                    iconSize: [36, 36],
                    iconAnchor: [18, 18],
                    popupAnchor: [0, -18]
                })
            });

            marker.id = ao.id;
            marker.on('click', async () => {
                try {
                    const response = await fetch(`/api/popup/${marker.id}`);
                    const content = await response.text();
                    marker.bindPopup(content).openPopup();
                } catch (e) {
                    marker.bindPopup(`
                        <div class="p-4 text-red-500">
                            Erreur de chargement<br>
                            <button onclick="this.closest('.leaflet-popup')._source.openPopup()">Réessayer</button>
                        </div>
                    `).openPopup();
                }
            });

            return marker;
        };

        // Ajout des marqueurs initiaux
        initialData.forEach(ao => {
            const marker = createMarker(ao);
            markerLookup[ao.id] = marker;
            markersCluster.addLayer(marker);
        });

        map.addLayer(markersCluster);

        // Gestion des clics sur la liste
        document.getElementById('result-list')?.addEventListener('click', (e) => {
            const item = e.target.closest('[data-ao-id]');
            if (item && markerLookup[item.dataset.aoId]) {
                map.flyTo(markerLookup[item.dataset.aoId].getLatLng(), 15, { duration: 0.5 });
                markerLookup[item.dataset.aoId].openPopup();
            }
        });

        // Gestion du formulaire de filtre
        document.getElementById('filter-btn')?.addEventListener('click', async (e) => {
            e.preventDefault();
            const spinner = document.getElementById('spinner');
            spinner?.classList.remove('hidden');

            try {
                const form = document.getElementById('filter-form');
                const params = new URLSearchParams(new FormData(form));
                const response = await fetch(`${aoListUrl}?${params.toString()}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                const data = await response.json();
                document.getElementById('result-list').innerHTML = data.html;

                markersCluster.clearLayers();
                data.markers.forEach(markerData => {
                    const marker = L.marker([markerData.lat, markerData.lng])
                        .bindPopup(markerData.popup);
                    markersCluster.addLayer(marker);
                });
            } finally {
                spinner?.classList.add('hidden');
            }
        });
    };

    // Gestion Turbo
    document.addEventListener('turbo:load', initializeMap);
    document.addEventListener('turbo:before-cache', () => {
        if (map) {
            map.remove();
            map = null;
            markersCluster = null;
            markerLookup = {};
        }
    });

    initializeMap();
});