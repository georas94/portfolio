import React, { useState, useEffect } from 'react';
import {
    View,
    Button,
    Image,
    Text,
    Alert,
    StyleSheet,
    ActivityIndicator,
} from 'react-native';
import * as ImagePicker from 'expo-image-picker';

const CLOUD_API_URL = 'https://api.dynamsoft.com/barcode/v1/recognize';
const LICENSE_KEY = 't0087pwAAAEVjyCVjYOS21tbipYGdSrulQRPwwU5m6U+2nPR7rgMzYQ1lSLSIBHbVOOo+KtK8EmlEihy+WqErKj7EzxHLaa7RDVkbs2z0vfGHuSnhegEZmiGP;t0090pwAAAENzW+criI6cf19lxeZ22TFpat/N0yALildRgCfQKeuaBtD+Hb0Wq3xfTHcp3+POhlBz9dYKir0xiWQ86v+cnezlnkO+6NJDzWOjrx9/mZsSriczuyG7';  // Ta clé “cloud” Dynamsoft

export default function App() {
    const [imageUri, setImageUri] = useState<string | null>(null);
    const [result, setResult] = useState<any>(null);
    const [loading, setLoading] = useState(false);

    const pickImage = async () => {
        // 1. Demande de permission
        const { status } = await ImagePicker.requestMediaLibraryPermissionsAsync();
        if (status !== 'granted') {
            Alert.alert('Permission requise', 'Autorise l’accès aux photos.');
            return;
        }

        // 2. Ouvre la bibliothèque en demandant le base64
        const result = await ImagePicker.launchImageLibraryAsync({
            allowsEditing: false,
            quality: 0.8,
            base64: true,
        });

        // 3. Vérifie si l'utilisateur a annulé
        if (result.canceled || result.assets.length === 0) {
            return;
        }

        const asset = result.assets[0];
        setImageUri(asset.uri);
        await recognizeBarcode(asset.base64!);
    };

    // 4. Envoi au cloud Dynamsoft
    const recognizeBarcode = async (base64: string) => {
        setLoading(true);
        try {
            useEffect(() => {
                fetch('https://httpbin.org/get')
                    .then(res => {
                        console.log('Statut GET httpbin:', res.status);
                        return res.json();
                    })
                    .then(json => Alert.alert('Réponse httpbin:', json))
                    .catch(err => Alert.alert('Erreur httpbin:', err));
            }, []);

            const resp = await fetch(CLOUD_API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'x-license-key': LICENSE_KEY,
                },
                body: JSON.stringify({
                    image: base64,
                    template: { barcodeFormatIds: ['BF_PDF417'] }, // PDF417 uniquement
                }),
            });
            const json = await resp.json();
            if (json.readerResults?.length) {
                setResult(json.readerResults);
                Alert.alert(
                    'Résultat',
                    json.readerResults.map((r: any) => r.barcodeText).join('\n')
                );
            } else {
                Alert.alert('Aucun code détecté');
            }
        } catch (e: any) {
            Alert.alert('Erreur API', e);
        } finally {
            setLoading(false);
        }
    };

    return (
        <View style={styles.container}>
            <Button title="Choisir une image" onPress={pickImage} />
            {loading && <ActivityIndicator style={{ margin: 20 }} />}
            {imageUri && <Image source={{ uri: imageUri }} style={styles.image} />}
            {result && (
                <View style={styles.results}>
                    <Text style={styles.title}>Résultats :</Text>
                    {result.map((r: any, i: number) => (
                        <Text key={i}>
                            {r.barcodeFormat} → {r.barcodeText}
                        </Text>
                    ))}
                </View>
            )}
        </View>
    );
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        padding: 20,
        alignItems: 'center',
        justifyContent: 'center',
    },
    image: {
        width: 300,
        height: 300,
        marginVertical: 20,
        borderRadius: 8,
    },
    results: {
        marginTop: 20,
    },
    title: {
        fontWeight: 'bold',
        marginBottom: 10,
    },
});
