document.addEventListener('DOMContentLoaded', function () {
    
    const data = fetch('http://blank-v6-beta.local/wp-content/themes/blankv6/blocks/api-test/api-test-2.json');

    data.then(response => {
        return response.json();
    }).then(data => {

        const campingsArray = data.datos;

        // Object of arrays with 'zona' key
        const zoneObject = campingsArray.reduce((acc,obj) => {
            return {...acc, [obj.zona]: [...acc[obj.zona] || [], obj]};
        }, {})

        // Array of arrays 
        const zoneArray = Object.values(zoneObject);

        console.log(zoneArray);

        // HTML content
        zoneArray.forEach(zone => {
            console.log('zone', zone);
            const zoneContainer = document.createElement("div");
            zoneClass = zone[0].zona.toLowerCase();
            zoneContainer.classList.add("zone-container");
            zoneContainer.classList.add(zoneClass);

            const zoneTitle = document.createElement("h2");
            const zoneName = document.createTextNode(zone[0].zona);
            
            zoneTitle.classList.add("zone-title");

            zoneTitle.appendChild(zoneName);

            zoneContainer.appendChild(zoneTitle);

            zone.forEach(camping => {
                const campingCard = document.createElement("div");
                campingCard.classList.add("camping-card");

                const campingName = document.createElement("p");
                campingName.classList.add("camping-name");
                const campingNameText = document.createTextNode(camping.nom);
                campingName.appendChild(campingNameText);

                const campingEmail = document.createElement("p");
                campingEmail.classList.add("camping-email");
                const campingEmailText = document.createTextNode(camping.email);
                campingEmail.appendChild(campingEmailText);

                campingCard.appendChild(campingName);
                campingCard.appendChild(campingEmail);

                zoneContainer.appendChild(campingCard);
            });

            const container = document.querySelector(".wp-block-api-test");
            container.appendChild(zoneContainer);
         });

        
        // data.datos.forEach((dato) => {
        //     const datoCard = document.createElement("div");
        //     datoCard.classList.add("dato-card");
            
        //     const nameP = document.createElement("p");
        //     nameP.classList.add("name");
        //     const datoName = document.createTextNode(dato.nom);
        //     nameP.appendChild(datoName);
            
        //     const zoneP = document.createElement("p");
        //     zoneP.classList.add("zone");
        //     const datoZone = document.createTextNode(dato.zona);
        //     zoneP.appendChild(datoZone);
            
        //     const emailP = document.createElement("p");
        //     emailP.classList.add("email");
        //     const datoEmail = document.createTextNode(dato.email);
        //     emailP.appendChild(datoEmail);
            
        //     datoCard.appendChild(nameP);
        //     datoCard.appendChild(zoneP);
        //     datoCard.appendChild(emailP);
        //     const container = document.querySelector(".wp-block-api-test");
            
        //     container.appendChild(datoCard);
        // })    
    });
    

});