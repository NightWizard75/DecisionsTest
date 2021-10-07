let select = document.getElementById('groups');
let original = Object.getOwnPropertyDescriptor(HTMLSelectElement.prototype, 'value');
if (select) {
	Object.defineProperty(select, 'value', {
		get: original.get,
		set(val) {
			let old = this.value
			let res = original.set.call(this, val)
			if (old != val) this.dispatchEvent(new Event('change'))
			return res
		}
	})
}

function ChangeAction(formName, action_name) {
	document[formName].action = "/"+action_name;
}

function ChangeUser(element) {
	getUserById(element.options[element.options.selectedIndex].value)
}

function ChangeGroup(element) {
	let $value = 0;
	if (element.options.selectedIndex !== -1
		&& element.options[element.options.selectedIndex] !== null) {
		$value = element.options[element.options.selectedIndex].value;
	}
	getUsersByGroupId($value)
}

function getUserById(id) {
	let $url = '/user/xhrGetUserById'
	let userName = document.getElementById('userName');
	let userClass = document.getElementById('userClass');
	let groups = document.getElementById('groups');
	$.ajax({
		url: $url,
		type: 'POST',
		data: {
			id: id
		},
		dataType: 'html',
		success: function($data) {
			let response = JSON.parse($data);
			if (typeof (response.data.info.Id) !== 'undefined' && response.data.info.Id !== null) {
				userName.innerHTML = response.data.info.FirstName + " " + response.data.info.LastName;
				userClass.innerHTML = response.data.info.SchoolClass;
				groups.value = (response.data.info.GroupId) ? response.data.info.GroupId : 0;
			} else {
				userName.innerHTML = '';
				userClass.innerHTML = '';
				groups.value = 0;
			}
		}
	});
}

function getUsersByGroupId(groupId) {
	let $url = '/user/xhrGetUsersByGroupId'
	let groupUsers = document.getElementById('groupUsers');
	let groupUsersCount = document.getElementById('groupUsersCount');
	$.ajax({
		url: $url,
		type: 'POST',
		data: {
			groupId: groupId
		},
		dataType: 'html',
		success: function ($data) {
			let response = JSON.parse($data);
			groupUsersCount.innerText = response.data.info.length;
			groupUsers.innerHTML = '';
			for (let i = 0; i < response.data.info.length; i++) {
				let $node = document.createElement('option');
				$node.innerHTML = response.data.info[i].first_name
					+ ' ' + response.data.info[i].last_name
					+ ' (' + response.data.info[i].class + ')'
				groupUsers.appendChild($node);
			}
		}
	});
}

function changeUserGroup() {
	let $url = '/user/xhrChangeUserGroup'
	let users = document.getElementById('users');
	let userId = users.options[users.options.selectedIndex].value;
	let groups = document.getElementById('groups');
	let groupId = groups.options[groups.options.selectedIndex].value;
	let groupUsers = document.getElementById('groupUsers');
	let groupUsersCount = document.getElementById('groupUsersCount');
	if (typeof (userId) !== 'undefined' && userId > 0) {
		$.ajax({
			url: $url,
			type: 'POST',
			data: {
				userId: userId,
				groupId: groupId
			},
			dataType: 'html',
			success: function ($data) {
				let response = JSON.parse($data);
				groupUsersCount.innerText = response.data.info.length;
				groupUsers.innerHTML = '';
				for (let i = 0; i < response.data.info.length; i++) {
					let $node = document.createElement('option');
					$node.innerHTML = response.data.info[i].first_name
						+ ' ' + response.data.info[i].last_name
						+ ' (' + response.data.info[i].class + ')'
					groupUsers.appendChild($node);
				}
			}
		});
	} else {
		console.log('Вывести ошибку');
	}
}