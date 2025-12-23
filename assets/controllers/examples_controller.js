import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = {
        id: Number,
    }

    // connect() {
    //     console.log("Id:", this.idValue); // "John"
    //     console.log("Daypart:", this.daypartValue); // 5
    // }
    // ...
    loadInput() {
        console.log("Id:", this.idValue);
    }

    async loadInput() {
        const inputId = this.idValue;

        try {
            const response = await fetch(`/api/exampleinput/${inputId}`);
            const data = await response.json();
            document.getElementById('day_input').value = data.value;
            console.log(data); // Hier doe je iets met de data, zoals tonen in een modal
        } catch (error) {
            console.error("Fout bij ophalen product:", error);
        }
    }
}
