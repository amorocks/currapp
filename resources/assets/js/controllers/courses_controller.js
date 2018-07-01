import { Controller } from "stimulus"

export default class extends Controller {

	static targets = ["assigned", "available"]
  
	toggle(event) {

		var el = event.currentTarget
		var assigned = this.assignedTarget
		var available = this.availableTarget
		var confirmation = "Weet je het zeker? Je verwijdert hiermee ook de onderliggende planning, readers, etc."

		var icon = el.getElementsByTagName("i")[0];
		if(icon.classList.contains("fa-trash") && !window.confirm(confirmation)) return;
		icon.className = "fas fa-fw fa-spinner fa-spin fa-lg";

		axios.post('/curriculum/toggle/term/' + this.element.dataset.term + '/course/' + el.dataset.id)
		.then(function (response) {
			
			var added = (response.data) ? true : false;
			if(added)
			{
				available.removeChild(el)
				assigned.appendChild(el)
				icon.className = "fas fa-fw fa-trash"
			}
			else
			{
				assigned.removeChild(el)
				available.appendChild(el)
				icon.className = "fas fa-fw fa-plus"
			}

		})
		.catch(function (error) {
			console.log(error);
		});
	}
}
