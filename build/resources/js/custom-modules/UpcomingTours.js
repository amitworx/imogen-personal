function UpcomingTours(){

    // "url": "https://www.bandsintown.com/t/1234?app_id=yOUrSuP3r3ven7aPp-id&came_from=267&utm_medium=api&utm_source=public_api&utm_campaign=ticket"  

    // https://www.bandsintown.com/e/123456?app_id=yOUrSuP3r3ven7aPp-id&came_from=267&utm_medium=api&utm_source=public_api&utm_campaign=event&trigger=rsvp_going    

        document.addEventListener('DOMContentLoaded', function(){
            let upcomingTours = document.querySelector('.upcoming__tours-5');
            let upcomingToursAll = document.querySelector('.upcoming__tours-all');
            let artistID = 'id_1631727';
            let appID = '31c76b91b7cb84b0dfb67ce5a6ef1f29';
            if(upcomingTours){
                fetch(`https://rest.bandsintown.com/artists/${artistID}/events?app_id=${appID}`)
                .then(response => response.json())
                .then(data => {
                    let upcomingToursHTML = '';
                    for(let i = 0; i < 5; i++){
                            let eventDateTime = new Date( data[i].starts_at ) ;
                            let eventDate = eventDateTime.toLocaleDateString();
                            let eventTime = eventDateTime.toLocaleTimeString('en-AU');
                            let eventMonth = eventDateTime.toLocaleString('en-AU', { month: 'short' });
                            let eventDay = eventDateTime.getDate();
                            let eventWeekday = eventDateTime.toLocaleString('en-AU', { weekday: 'long' });
                            let ticket = data[i].offers;
                            let tk = ticket.reduce(function(tkt){
                                if( tkt.type == 'Tickets'){
                                    return tkt.url;
                                }
                            });
                            let ticketURL = `https://www.bandsintown.com/t/${data[i].id}?app_id=${appID}&came_from=267&utm_medium=api&utm_source=public_api&utm_campaign=ticket`;
                            let rsvp = `https://www.bandsintown.com/e/${data[i].id}?app_id=${appID}&came_from=267&utm_medium=api&utm_source=public_api&utm_campaign=event&trigger=rsvp_going`;
                            console.log(tk);
                            upcomingToursHTML += `
                                <div class="tours__row">
                                    <div class="tours__tour-info">
                                        <div class="tours__tour-date">
                                            ${eventMonth} ${eventDay} ${eventWeekday};
                                        </div>
                                        <a href="${data[i].url}" rel="noopener" target="_blank">
                                            <div class="tours__tour-title">
                                                ${data[i].venue.name} @ ${eventTime}
                                            </div>
                                            ${data[i].description ? `<div class="tours__tour-desc">${data[i].description}</div>` : ''}
                                        </a>
                                    </div>
                                    <div class="tours__location">
                                        <a href="${data[i].url}" rel="noopener" target="_blank">
                                            ${data[i].venue.location}
                                        </a>
                                    </div>
                                    <div class="tours__buttons">
                                        <div class="tours__buttons-ticket">
                                            <a href="${ticketURL}" target="_blank"> 
                                                Tickets
                                            </a>
                                        </div>
                                        <div class="tours__buttons-rsvp">
                                            <a href="${rsvp}"  target="_blank"> 
                                                RSVP 
                                            </a>
                                        </div>
                                    </div>
                            </div>`;
                        }
                    upcomingTours.innerHTML = upcomingToursHTML;
                }).catch(err => {
                    console.log(err);
                })
            }
            if(upcomingToursAll){
                fetch(`https://rest.bandsintown.com/artists/${artistID}/events?app_id=${appID}`)
                .then(response => response.json())
                .then(data => {
                    let upcomingToursHTML = '';
                    for(let i = 0; i < data.length; i++){
                            let eventDateTime = new Date( data[i].starts_at ) ;
                            let eventDate = eventDateTime.toLocaleDateString();
                            let eventTime = eventDateTime.toLocaleTimeString('en-AU');
                            let eventMonth = eventDateTime.toLocaleString('en-AU', { month: 'short' });
                            let eventDay = eventDateTime.getDate();
                            let eventWeekday = eventDateTime.toLocaleString('en-AU', { weekday: 'long' });
                            let ticket = data[i].offers;
                            let tk = ticket.reduce(function(tkt){
                                if( tkt.type == 'Tickets'){
                                    return tkt.url;
                                }
                            });
                            let ticketURL = `https://www.bandsintown.com/t/${data[i].id}?app_id=${appID}&came_from=267&utm_medium=api&utm_source=public_api&utm_campaign=ticket`;
                            let rsvp = `https://www.bandsintown.com/e/${data[i].id}?app_id=${appID}&came_from=267&utm_medium=api&utm_source=public_api&utm_campaign=event&trigger=rsvp_going`;
                            console.log(tk);
                            upcomingToursHTML += `
                                <div class="tours__row">
                                    <div class="tours__tour-info">
                                        <div class="tours__tour-date">
                                            ${eventMonth} ${eventDay} ${eventWeekday};
                                        </div>
                                        <a href="${data[i].url}" rel="noopener" target="_blank">
                                            <div class="tours__tour-title">
                                                ${data[i].venue.name} @ ${eventTime}
                                            </div>
                                            ${data[i].description ? `<div class="tours__tour-desc">${data[i].description}</div>` : ''}
                                        </a>
                                    </div>
                                    <div class="tours__location">
                                        <a href="${data[i].url}" rel="noopener" target="_blank">
                                            ${data[i].venue.location}
                                        </a>
                                    </div>
                                    <div class="tours__buttons">
                                        <div class="tours__buttons-ticket">
                                            <a href="${ticketURL}" target="_blank"> 
                                                Tickets
                                            </a>
                                        </div>
                                        <div class="tours__buttons-rsvp">
                                            <a href="${rsvp}"  target="_blank"> 
                                                RSVP 
                                            </a>
                                        </div>
                                    </div>
                            </div>`;
                        }
                        upcomingToursAll.innerHTML = upcomingToursHTML;
                }).catch(err => {
                    console.log(err);
                })
            }


        });

}
export default UpcomingTours;