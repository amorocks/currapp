import { Controller } from "stimulus"

export default class extends Controller {

    static targets = ["assigned", "available", "tags"]
  
    toggle(event) {

        var el = event.currentTarget
        var el2 = event.currentTarget.cloneNode(true);
        var assigned = this.assignedTarget
        var available = this.availableTarget
        var tags = this.tagsTarget

        var icon = el.getElementsByTagName("i")[0];
        icon.className = "fas fa-fw fa-spinner fa-spin fa-lg";

        axios.post('/courses/' + this.element.dataset.course + '/toggle/tag/' + el.dataset.id)
        .then(function (response) {
            
            var added = (response.data) ? true : false;
            if(added)
            {
                tags.insertBefore(el2.getElementsByTagName("span")[0], document.getElementById('add-link'))
                available.removeChild(el)
                assigned.appendChild(el)
                icon.className = "fas fa-fw fa-trash mr-2"
            }
            else
            {
                assigned.removeChild(el)
                available.appendChild(el)
                icon.className = "fas fa-fw fa-plus mr-2"
            }

        })
        .catch(function (error) {
            console.log(error);
        });
    }
}
