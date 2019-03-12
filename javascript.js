var game = new Phaser.Game(600,600); 
var vitesse = 800;
var dodger = {

	preload:function(){
		//chargement images
		game.load.image('fond', 'fond.png'); //nom de l'objet puis lien vers l'image
		game.load.image('player', 'player.png');
		game.load.image('mechant', 'mechant.png');

	},
	create:function(){
		//setup + affichage
		game.physics.startSystem(Phaser.Physics.ARCADE); //appel la physic

		game.add.sprite(0,0,'fond');
		this.player = game.add.sprite(300,500,'player');
		this.player.anchor.set(0.5); //anchor permet de centrer l'image

		game.physics.arcade.enable(this.player); //affecte la physic à un objet

		cursors = game.input.keyboard.createCursorKeys(); //écoute du clavier

		this.mechants = game.add.group();

		this.timer = game.time.events.loop(200, this.ajouterMechants, this); //boucle ajouter méchant

		this.score = 0;
		this.labelScore = game.add.text(20,20,"0",{font:"30px Arial", fill: "#fff"}); //paramètres score

	},
	update:function(){
		//logique du jeu
		game.physics.arcade.overlap(this.player,this.mechants, this.restartGame, null, this);

		this.player.body.velocity.x=0; //remet à zero a chaque fois
		this.player.body.velocity.y=0;

		//déplacements personnage

		if(cursors.left.isDown){
			this.player.body.velocity.x = vitesse * -1; //300 = vitesse
		}
		if(cursors.right.isDown){
			this.player.body.velocity.x = vitesse;
		}
		if(cursors.up.isDown){
			this.player.body.velocity.y = vitesse * -1;
		}
		if(cursors.down.isDown){
			this.player.body.velocity.y = vitesse;
		}

		if(this.player.inWorld ==false){

			this.restartGame(); //appel la fonction restartGame

		}
	},
	restartGame:function(){

		game.state.start('dodger');

	},
	ajouterMechants:function(){

		var position = Math.floor(Math.random() * 550) + 1;
		var mechant = game.add.sprite(position,0,'mechant');
		game.physics.arcade.enable(mechant); //affecte la physic à un objet
		mechant.body.gravity.y = 200;
		this.mechants.add(mechant);

		this.score += 20; //score de départ
		this.labelScore.text = this.score; //afficher le score

		mechant.checkWorldBounds= true; //vérifie si présent sur le plateau
		mechant.outOfBoundsKill = true;

	}
};

game.state.add('dodger',dodger);
game.state.start('dodger');
