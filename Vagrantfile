VAGRANTFILE_API_VERSION = "2"

Vagrant.require_version ">= 1.7.4"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

    # Box configuration
    config.vm.box = "ubuntu/trusty64"

    # VM configuration
    config.vm.provider "virtualbox" do |v|
        v.memory = 2048
        v.cpus = 1
    end

    # Welcome message
    config.vm.post_up_message = "Development server is ready."

    # Port forwarding
    config.vm.network "forwarded_port", guest: 80, host: 8080, auto_correct: true

    # Synced folders
    config.vm.synced_folder ".", "/vagrant", :owner => 'root', :group => 'root', :mount_options => ["dmode=777", "fmode=777"]

    # Provisioning script
    config.vm.provision "shell", path: "bootstrap.sh"

end