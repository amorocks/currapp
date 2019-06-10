import { Controller } from "stimulus"

export default class extends Controller {

    static targets = ["assigned", "available", "tags", "select"]
  
    toggle(event) {

        var el = event.currentTarget
        var icon = el.getElementsByTagName("i")[0]
        var id = el.dataset.id

        var assigned = this.assignedTarget
        var available = this.availableTarget
        var tags = this.tagsTarget
        var select = this.selectTarget
        
        var option = select.querySelector("option[value='" + id + "']");
        option.selected  = option.selected ? false : true;

        if(option.selected)
        {
            //copy and extract from modal
            var el2 = event.currentTarget.cloneNode(true).getElementsByTagName("span")[0];
            el2.id = "badge-" + id;

            //add badge to list on mainpage
            tags.insertBefore(el2, document.getElementById('add-link'))

            //toggle in modal
            available.removeChild(el)
            assigned.appendChild(el)
            icon.className = "fas fa-fw fa-trash mr-2"
        }
        else
        {
            //remove badge from mainpage
            document.getElementById("badge-" + id).remove()
            assigned.removeChild(el)
            available.appendChild(el)
            icon.className = "fas fa-fw fa-plus mr-2"
        }
    }
}
