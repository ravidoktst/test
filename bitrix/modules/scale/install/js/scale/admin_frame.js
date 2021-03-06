/**
 * BX.Scale.AdminFrame class - main class to administer virtual machines, scale etc.
 */
;(function(window) {

	if (BX.Scale.AdminFrame) return;

	BX.Scale.AdminFrame = {

		frameObjectName: "",
		srvFrameObjectName: "",
		currentAsyncActionBID: "", //Bitrix ID for async long actions.
		timeAsyncRefresh: 20000, //ms
		timeIntervalId: "",
		graphPageUrl: "",
		failureAnswersCount: 0,
		failureAnswersCountAllow: 3,
		nextActionId: null,

		/**
		 * Initializes frame params
		 */
		init: function (params)
		{
			for(var key in params)
				this[key] = params[key];
		},

		/**
		 * Prepares & builds main frame objects
		 */
		build: function()
		{
			var frameObj = BX(this.frameObjectName);

			if(!frameObj)
				return false;

			this.showActions();
			this.showServers();

			return true;
		},

		showServers: function()
		{
			var frameObj = BX(this.srvFrameObjectName),
				servers = BX.Scale.serversCollection.getObjectsList(),
				newSrv = frameObj.children[0];

			if(frameObj)
				for(var key in servers)
					frameObj.insertBefore(servers[key].getDomObj(), newSrv);
		},

		isObjectEmpty: function (obj)
		{
			for (var i in obj)
				return false;

			return true;
		},

		showActions: function()
		{
			var frameObj = BX(this.frameObjectName);

			if(!frameObj)
				return false;

			if(!this.isObjectEmpty(BX.Scale.serversCollection.getObjectsList()))
				frameObj.insertBefore(this.getMenuObj(), frameObj.children[0]);
		},

		/**
		 * Starts the process of monitoring data refreshing
		 * @param {number} timeInterval - ms how often we must refresh data
		 */
		refreshingDataStart: function(timeInterval)
		{
			BX.Scale.AdminFrame.refreshingDataIntervalId = setInterval( function() {
					BX.Scale.AdminFrame.refreshServersRolesLoadbars();
				},
				timeInterval
			);
		},

		/**
		 * Sets the servers roles loadbar values
		 * @param {object} monitoringData
		 */
		setMonitoringValues: function(monitoringData)
		{
			for(var hostname in monitoringData)
			{
				var server = BX.Scale.serversCollection.getObject(hostname);

				if(monitoringData[hostname].ROLES_LOADBARS)
				{
					for(var roleId in  monitoringData[hostname].ROLES_LOADBARS)
					{
						if(server && server.roles && server.roles[roleId])
						{
							server.roles[roleId].setLoadBarValue(monitoringData[hostname].ROLES_LOADBARS[roleId]);
						}
					}
				}

				if(monitoringData[hostname].MONITORING_VALUES)
					server.setMonitoringValues(monitoringData[hostname].MONITORING_VALUES);
			}
		},

		/**
		 * Receives the data from server for server roles loadbars using ajax request
		 */
		refreshServersRolesLoadbars: function()
		{
			if(!BX.Scale.AdminFrame.monitoringParams)
			{
				BX.Scale.AdminFrame.monitoringParams = {};

				var servers = BX.Scale.serversCollection.getObjectsList();

				for(var srvId in servers)
				{
					if(!BX.Scale.isMonitoringDbCreated[srvId])
						continue;

					BX.Scale.AdminFrame.monitoringParams[srvId] = {
						rolesIds:[],
						monitoringParams: servers[srvId].getMonitoringParams()
					};

					for(var roleId in  servers[srvId].roles)
					{
						if(servers[srvId].roles[roleId].loadBar !== null)
						{
							BX.Scale.AdminFrame.monitoringParams[srvId].rolesIds.push(roleId);
						}
					}
				}
			}

			if(BX.Scale.isObjEmpty(BX.Scale.AdminFrame.monitoringParams))
				return;

			var sendPrams = {
				operation: "get_monitoring_values",
				servers: BX.Scale.AdminFrame.monitoringParams
			};

			var callbacks = {
				onsuccess: function(result){
					if(result)
					{
						if(result.MONITORING_DATA)
						{
							BX.Scale.AdminFrame.setMonitoringValues(result.MONITORING_DATA);
						}

						if(result.ERROR && result.ERROR.length > 0)
						{
							BX.debug("Monitoring data error: "+result.ERROR);
						}
					}
					else
					{
						BX.debug("Monitoring receiving data error.");
					}
				},
				onfailure: function(){
					BX.debug("Monitoring receiving data failure.");
				}
			};

			BX.Scale.Communicator.sendRequest(sendPrams, callbacks, this, false);
		},


		getMenuObj: function()
		{
			var domObj = document.createElement("span");
			BX.addClass(domObj, "adm-scale-menu-btn");
			domObj.innerHTML = BX.message("SCALE_PANEL_JS_GLOBAL_ACTIONS");
			BX.bind(domObj, "click", BX.proxy(this.actionsMenuOpen, this));
			return BX.create("div",{children:[domObj], style:{padding:"0 0 40px 0"}});
		},

		actionsMenuOpen: function(event)
		{
			event = event || window.event;
			var menuButton = event.target || event.srcElement,
				menuItems = [],
				settMenu = [],
				actionsIds = {
					NEW_SERVER_CHAIN: true,
					MONITORING_ENABLE: true,
					MONITORING_DISABLE: true,
					SITE_ADD: true,
					SITE_DEL: true,
					SET_EMAIL_SETTINGS: true,
					CRON_SET: true,
					CRON_UNSET: true,
					HTTP_OFF: true,
					HTTP_ON: true,
					UPDATE_ALL_BVMS: true
				},
				s;

			for(var key in actionsIds)
			{
				var action = BX.Scale.actionsCollection.getObject(key);

				if(action)
				{
					if(key == "SET_EMAIL_SETTINGS")
					{
						settMenu = [];

						for(s in BX.Scale.sitesList)
						{
							settMenu.push({
								TEXT: BX.Scale.sitesList[s].NAME,
								ONCLICK: "BX.Scale.actionsCollection.getObject('"+key+"').start('',{SITE_NAME: '"+BX.Scale.sitesList[s].NAME+"',SMTP_HOST: BX.Scale.sitesList['"+s+"'].SMTPHost,SMTP_PORT: BX.Scale.sitesList['"+s+"'].SMTPPort,SMTP_USER: BX.Scale.sitesList['"+s+"'].SMTPUser,EMAIL: BX.Scale.sitesList['"+s+"'].EmailAddress,SMTPTLS: (BX.Scale.sitesList['"+s+"'].SMTPTLS == 'on' ? 'Y' : 'N')});"
							});
						}

						menuItems.push({
							TEXT: action.name,
							MENU: settMenu
						});
					}
					else if(key == "CRON_SET" || key == "CRON_UNSET" )
					{
						settMenu = [];
						for(s in BX.Scale.sitesList)
						{
							if(
								(BX.Scale.sitesList[s].CronTask == "enable" && key == "CRON_UNSET")
								|| (BX.Scale.sitesList[s].CronTask != "enable" && key == "CRON_SET")
								)
							{
								settMenu.push({
									TEXT: BX.Scale.sitesList[s].NAME,
									ONCLICK: "BX.Scale.actionsCollection.getObject('"+key+"').start('',{VM_SITE_ID: '"+s+"'});"
								});
							}
						}

						if(settMenu.length > 0)
						{
							menuItems.push({
								TEXT: action.name,
								MENU: settMenu
							});
						}
					}
					else if(key == "HTTP_OFF" || key == "HTTP_ON" )
					{
						settMenu = [];
						for(s in BX.Scale.sitesList)
						{
							if(
								(BX.Scale.sitesList[s].HTTPS == "enable" && key == "HTTP_ON")
									|| (BX.Scale.sitesList[s].HTTPS != "enable" && key == "HTTP_OFF")
								)
							{
								settMenu.push({
									TEXT: BX.Scale.sitesList[s].NAME,
									ONCLICK: "BX.Scale.actionsCollection.getObject('"+key+"').start('',{VM_SITE_ID: '"+s+"'});"
								});
							}
						}

						if(settMenu.length > 0)
						{
							menuItems.push({
								TEXT: action.name,
								MENU: settMenu
							});
						}
					}
					else if(key == "NEW_SERVER_CHAIN")
					{
						menuItems.push({
							TEXT: action.name,
							ONCLICK: "BX.Scale.actionsCollection.getObject('"+key+"').start('',{ HOSTNAME: '"+this.getNewServerName()+"'});"
						});
					}
					else if(key == "SITE_ADD")
					{
						menuItems.push({
							TEXT: action.name,
							ONCLICK: "BX.Scale.actionsCollection.getObject('"+key+"').start();"
						});
					}
					else if(key == "SITE_DEL")
					{
						settMenu = [];

						for(s in BX.Scale.sitesList)
						{
							settMenu.push({
								TEXT: BX.Scale.sitesList[s].NAME,
								ONCLICK: "BX.Scale.actionsCollection.getObject('"+key+"').start('',{VM_SITE_ID: '"+s+"'})"
							});
						}

						menuItems.push({
							TEXT: action.name,
							MENU: settMenu
						});
					}
					else
					{
						menuItems.push({
							TEXT: action.name,
							ONCLICK: "BX.Scale.actionsCollection.getObject('"+key+"').start();"
						});
					}
				}
			}

			if (!menuButton.OPENER)
				BX.adminShowMenu(menuButton, menuItems, {active_class: "bx-adm-scale-menu-butt-active"});
			else
				menuButton.OPENER.SetMenu(menuItems);

			return BX.PreventDefault(event);
		},

		getNewServerName: function(idx)
		{
			if(!idx)
				idx = 1;

			var hostname = "server"+idx;
			var server = BX.Scale.serversCollection.getObject(hostname);

			if(server !== false)
			{
				idx++;
				hostname = this.getNewServerName(idx);
			}

			return hostname;
		},

		alert: function(text, title, callback)
		{
			var btnClose = {
				title: BX.message("SCALE_PANEL_JS_CLOSE"),
				id: 'btnClose',
				name: 'btnClose',

				action: function () {
					this.parentWindow.Close();

					if(callback && typeof callback === 'function')
						callback.apply();
				}
			};

			this.dialogWindow = new BX.CDialog({
				title: title ? title : '',
				content: text,
				resizable: false,
				height: 200,
				width: 400,
				buttons: [ btnClose ]
			});

			this.dialogWindow.adjustSizeEx();
			this.dialogWindow.Show();
		},

		confirm: function(text, title, callbackOk, callbackCancel)
		{
			var btnOk = {
				title: "OK",
				id: 'btnOk',
				name: 'btnOk',
				className: 'adm-btn-save',

				action: function () {
					this.parentWindow.Close();

					if(callbackOk && typeof callbackOk === 'function')
						callbackOk.apply();
				}
			};

			var btnCancel = {
				title: BX.message("SCALE_PANEL_JS_CANCEL"),
				id: 'btnCancel',
				name: 'btnCancel',

				action: function () {
					this.parentWindow.Close();

					if(callbackCancel && typeof callbackCancel === 'function')
						callbackCancel.apply();
				}
			};

			this.dialogWindow = new BX.CDialog({
				title: title ? title : '',
				content: text,
				resizable: false,
				height: 200,
				width: 400,
				buttons: [ btnOk, btnCancel]
			});

			this.dialogWindow.adjustSizeEx();
			this.dialogWindow.Show();
		}
	}

})(window);