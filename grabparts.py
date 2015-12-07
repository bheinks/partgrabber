import urllib.request
from bs4 import BeautifulSoup
from collections import OrderedDict
from pprint import pprint
from sys import argv

class component:
    def __init__(self, comp_id, specs, name, prices):
        self.specs = specs
        self.prices = prices

        self.sql_specs = OrderedDict()
        self.sql_specs["comp_id"] = comp_id
        self.sql_specs["name"] = name
        self.sql_specs["manufacturer"] = specs[0]

class comp_case(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["form_factor"] = self.specs[2]

class cpu(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["architecture"] = self.specs[3]
        self.sql_specs["socket"] = self.specs[4]

class gpu(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["clock_speed"] = self.specs[6]
        self.sql_specs["vram"] = self.specs[4]

class motherboard(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["form_factor"] = self.specs[2]
        self.sql_specs["socket"] = self.specs[3]

class psu(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["wattage"] = self.specs[3]

class ram(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["capacity"] = self.specs[4]
        self.sql_specs["speed"] = self.specs[3]

class storage(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["capacity"] = self.specs[2]
        self.sql_specs["type"] = "SSD" if self.specs[4] == "N/A" else "HDD"

def main(comp_type, html_file):
    with open(html_file) as html:
        soup = BeautifulSoup(html, "html.parser")

    parts = []
    i = 0

    for name in soup.find_all("td", "tdname"):
        url = name.a.get("href")
        comp_id = url.split('/')[-1]
        parts.append(grab_part(comp_type, comp_id, url))
        i += 1

        if i == 5:
            break

    write_sql(comp_type, parts)

def write_sql(comp_type, parts):
    with open("add_parts.sql", 'a') as sql_file:
        print("INSERT INTO `{}` (`{}`) VALUES".format(comp_type, "`, `".join(parts[0].sql_specs.keys())))
        
        for part in parts:
            print("('{}')".format("', '".join(part.sql_specs.values())))


def grab_part(comp_type, comp_id, url):
    response = urllib.request.urlopen(url)
    soup = BeautifulSoup(response.read(), "html.parser")

    name = soup.find("h1", "name").string
    specs_block = soup.find("div", "specs block").find_all("h4")
    specs = [i.next_sibling.strip() for i in specs_block]

    prices_block = soup.find("div", "prices block")
    merchants = [i.parent.get("class")[0] for i in prices_block.find_all("td", "merchant")]
    prices = dict(zip(merchants, [i.a.contents[0] for i in prices_block.find_all("td", "total")]))

    part = globals()[comp_type](comp_id, specs, name, prices)

    return part

if __name__ == "__main__":
    main(argv[1], argv[2])
