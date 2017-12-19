import sys, re, os

class baseball:
    players=[]
    table={}
    flag=0
                
                
    def record(test, players):
        global flag
        playername=re.compile(r'(?P<name>[\w\s]+)\sbatted\s(?P<bats>\d)[\w\s]+with\s(?P<hits>\d)')
        match=playername.match(test)
        if match is not None:
            flag=0
            name = match.group('name')
            bat = int(match.group('bats'))
            hit = int(match.group('hits'))
            if players == [] :
                #print('1')
                player = {'name': name, 'bat': bat, 'hit': hit}
                players.append(player)
                        
            else:
                for player in players:
                    if player['name'] == name:
                        player['bat']=player['bat']+bat
                        player['hit']=player['hit']+hit
                        flag=1;
                        #print('here')
                if flag ==0:
                    player = {'name': name, 'bat': bat, 'hit': hit}
                    players.append(player)
    if len(sys.argv) < 2:
        sys.exit("Usage: %s filename" % sys.argv[0])
    filename = sys.argv[1]
    if not os.path.exists(filename):
        sys.exit("Error: File '%s' not found" % sys.argv[1])
        
    f=open(filename, 'r')
    for row in f:
        name=record(row,players)
    for player in players:
        avg = player['hit']/player['bat']
        avg = ('%03.3f' % avg)
        if table == {}:
            table = {player['name']:avg}
        else:
            table[player['name']]=avg
    for key,value in sorted(table.items(), key=lambda x: x[1], reverse=True):
        print (key, ':',value)


